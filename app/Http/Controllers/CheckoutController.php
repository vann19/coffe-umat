<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyPoint;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    // ── Konfigurasi Midtrans ──────────────────────────────────
    private function configureMidtrans(): void
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    // ────────────────────────────────────────────────────────────────────────
    // GET /checkout  — tampilkan halaman checkout
    // ────────────────────────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $cartJson = session('checkout_cart');
        if (!$cartJson) {
            return redirect()->route('dashboard')
                ->with('error', 'Keranjang kosong. Silakan pilih menu terlebih dahulu.');
        }

        $cart = json_decode($cartJson, true);
        if (empty($cart)) {
            return redirect()->route('dashboard')->with('error', 'Keranjang kosong.');
        }

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $tax      = (int) round($subtotal * 0.08);
        $total    = $subtotal + $tax;
        $clientKey = config('midtrans.client_key');

        return view('checkout', compact('cart', 'subtotal', 'tax', 'total', 'clientKey'));
    }

    // ────────────────────────────────────────────────────────────────────────
    // POST /checkout/prepare  — simpan cart ke session, return JSON
    // ────────────────────────────────────────────────────────────────────────
    public function prepare(Request $request)
    {
        $request->validate(['cart' => 'required|json']);
        session(['checkout_cart' => $request->cart]);
        return response()->json(['redirect' => route('checkout')]);
    }

    // ────────────────────────────────────────────────────────────────────────
    // POST /checkout  — buat order + ambil Snap token dari Midtrans
    // ────────────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'order_type' => 'required|in:dine-in,takeaway',
        ]);

        $cartJson = session('checkout_cart');
        if (!$cartJson) {
            return response()->json(['error' => 'Sesi keranjang kedaluwarsa. Silakan pilih menu kembali.'], 422);
        }
        $cart = json_decode($cartJson, true);
        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang kosong.'], 422);
        }

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $tax      = (int) round($subtotal * 0.08);
        $total    = $subtotal + $tax;
        $user     = Auth::user();

        try {
            DB::beginTransaction();

            // 1. Simpan order ke Supabase
            $order = Order::create([
                'user_id'        => $user->id,
                'total_price'    => $total,
                'status'         => 'pending',
                'order_type'     => $request->order_type,
                'payment_method' => 'midtrans',
            ]);

            // 2. Simpan order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'menu_id'   => $item['id'],
                    'item_name' => $item['name'],
                    'quantity'  => $item['qty'],
                    'price'     => $item['price'],
                ]);
            }

            // 3. Buat transaksi Midtrans Snap
            $this->configureMidtrans();

            $itemDetails   = collect($cart)->map(fn($i) => [
                'id'       => (string) $i['id'],
                'price'    => (int) $i['price'],
                'quantity' => (int) $i['qty'],
                'name'     => substr($i['name'], 0, 50),
            ])->toArray();
            $itemDetails[] = ['id' => 'TAX', 'price' => $tax, 'quantity' => 1, 'name' => 'Pajak (8%)'];

            $params = [
                'transaction_details' => [
                    'order_id'     => $order->id,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email'      => $user->email,
                ],
                'item_details' => $itemDetails,
                'callbacks'    => ['finish' => route('checkout.success', $order->id)],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);

            DB::commit();
            session()->forget('checkout_cart');

            return response()->json([
                'snap_token'  => $snapToken,
                'order_id'    => $order->id,
                'success_url' => route('checkout.success', $order->id),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Snap error: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ────────────────────────────────────────────────────────────────────────

    // GET /checkout/payment/{order}  — halaman instruksi pembayaran VA
    // ────────────────────────────────────────────────────────────────────────
    public function paymentInstruction(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Jika sudah paid, langsung ke halaman sukses
        if ($order->status === 'paid') {
            return redirect()->route('checkout.success', $order->id);
        }

        $items = OrderItem::where('order_id', $order->id)->get();
        return view('payment-instruction', compact('order', 'items'));
    }

    // ────────────────────────────────────────────────────────────────────────
    // POST /checkout/check-payment/{order}  — cek status ke Midtrans
    // ────────────────────────────────────────────────────────────────────────
    public function checkPayment(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $this->configureMidtrans();
            $status   = (object) \Midtrans\Transaction::status($order->id);
            $txStatus = $status->transaction_status ?? null;
            $fraud    = $status->fraud_status ?? 'accept';

            $isPaid = ($txStatus === 'settlement') ||
                      ($txStatus === 'capture' && $fraud === 'accept');

            if ($isPaid && $order->status !== 'paid') {
                $order->update([
                    'status'   => 'paid',
                    'paid_at'  => now(),
                ]);
                $this->awardLoyaltyPoints($order);
            }

            return response()->json([
                'status'   => $txStatus,
                'is_paid'  => $isPaid,
                'redirect' => $isPaid ? route('checkout.success', $order->id) : null,
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'unknown', 'is_paid' => false]);
        }
    }


    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // ── Verifikasi status ke Midtrans API (fallback untuk localhost) ──────
        // Webhook tidak bisa reach localhost, jadi kita cek langsung di sini
        if ($order->status === 'pending') {
            try {
                $this->configureMidtrans();

                $status = (object) \Midtrans\Transaction::status($order->id);
                $txStatus    = $status->transaction_status ?? null;
                $fraudStatus = $status->fraud_status ?? 'accept';

                $isPaid = ($txStatus === 'settlement') ||
                          ($txStatus === 'capture' && $fraudStatus === 'accept');

                if ($isPaid) {
                    $order->update([
                        'status'         => 'paid',
                        'payment_method' => $status->payment_type ?? 'midtrans',
                        'paid_at'        => now(),
                    ]);

                    // Award loyalty points (1 poin per Rp 1.000)
                    $this->awardLoyaltyPoints($order);
                }
            } catch (\Exception $e) {
                // Midtrans belum ada data transaksi — abaikan, lanjutkan tampilkan halaman
                Log::info('Midtrans status check on success page: ' . $e->getMessage());
            }
        }
        // ─────────────────────────────────────────────────────────────────────

        $order->refresh(); // Reload data terbaru setelah update
        $items = OrderItem::where('order_id', $order->id)->get();

        // Hitung poin yang didapat dari transaksi ini
        $earnedPoints = $order->status === 'paid'
            ? max(1, (int) floor($order->total_price / 1000))
            : 0;

        // Total poin user
        $totalPoints = LoyaltyPoint::where('user_id', Auth::id())->value('points') ?? 0;

        return view('checkout-success', compact('order', 'items', 'earnedPoints', 'totalPoints'));
    }

    // ── Helper: award loyalty points ──────────────────────────────────────────
    private function awardLoyaltyPoints(Order $order): void
    {
        if (!$order->user_id) return;

        $earnedPoints = max(1, (int) floor($order->total_price / 1000));

        $loyalty = LoyaltyPoint::where('user_id', $order->user_id)->first();
        if ($loyalty) {
            $loyalty->increment('points', $earnedPoints);
        } else {
            LoyaltyPoint::create([
                'user_id' => $order->user_id,
                'points'  => $earnedPoints,
            ]);
        }

        Log::info("Points awarded: user={$order->user_id} points={$earnedPoints} order={$order->id}");
    }

    // ────────────────────────────────────────────────────────────────────────
    // POST /checkout/notification  — webhook Midtrans
    // ────────────────────────────────────────────────────────────────────────
    public function notification(Request $request)
    {
        $this->configureMidtrans();

        try {
            $notif = new Notification();

            $orderId           = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $fraudStatus       = $notif->fraud_status;
            $paymentType       = $notif->payment_type;

            $order = Order::find($orderId);
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Tentukan status berdasarkan response Midtrans
            $newStatus = match(true) {
                $transactionStatus === 'capture' && $fraudStatus === 'accept' => 'paid',
                $transactionStatus === 'settlement'                           => 'paid',
                $transactionStatus === 'pending'                              => 'pending',
                in_array($transactionStatus, ['deny', 'cancel', 'expire'])   => 'canceled',
                $transactionStatus === 'failure'                              => 'failed',
                default                                                       => $order->status,
            };

            $updateData = [
                'status'         => $newStatus,
                'payment_method' => $paymentType ?? 'midtrans',
            ];

            if ($newStatus === 'paid') {
                $updateData['paid_at'] = now();

                // ─── Award Loyalty Points (1 poin per Rp 1.000) ───────────────
                if ($order->user_id) {
                    $earnedPoints = max(1, (int) floor($order->total_price / 1000));

                    $loyalty = LoyaltyPoint::where('user_id', $order->user_id)->first();
                    if ($loyalty) {
                        $loyalty->increment('points', $earnedPoints);
                    } else {
                        LoyaltyPoint::create([
                            'user_id' => $order->user_id,
                            'points'  => $earnedPoints,
                        ]);
                    }

                    Log::info("Loyalty points awarded: user={$order->user_id} points={$earnedPoints}");
                }
                // ──────────────────────────────────────────────────────────────
            }

            $order->update($updateData);

            Log::info("Midtrans notif: order={$orderId} status={$newStatus}");
            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans notification error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }
}
