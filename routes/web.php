<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckSessionExpiry;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// ── Midtrans Webhook  ─────────────────────────────────────────
// Route ini dikecualikan dari CSRF di bootstrap/app.php
Route::post('/checkout/notification', [CheckoutController::class, 'notification'])
    ->name('checkout.notification');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', fn() => view('pages.menu'))->name('menu');
Route::get('/lokasi', fn() => view('pages.lokasi'))->name('lokasi');
Route::get('/tentang', fn() => view('pages.tentang'))->name('tentang');
Route::get('/rewards', fn() => view('pages.rewards'))->name('rewards');

Route::get('/dashboard', function () {
    $user      = Auth::user();
    $menuItems = \App\Models\Menu::where('is_active', true)->get();

    // Riwayat pesanan user — hanya yang sudah lunas (10 terakhir)
    $orders = \App\Models\Order::where('user_id', $user->id)
        ->where('status', 'paid')
        ->orderByDesc('paid_at')
        ->limit(10)
        ->get()
        ->map(function ($order) {
            $order->items = \App\Models\OrderItem::where('order_id', $order->id)->get();
            return $order;
        });

    // Total poin loyalty
    $loyaltyPoints = \App\Models\LoyaltyPoint::where('user_id', $user->id)->value('points') ?? 0;

    return view('dashboard', compact('menuItems', 'orders', 'loyaltyPoints'));
})->middleware(['auth', CheckSessionExpiry::class])->name('dashboard');

Route::middleware(['auth', CheckSessionExpiry::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Checkout ──────────────────────────────────────────────
    Route::post('/checkout/prepare',           [CheckoutController::class, 'prepare'])->name('checkout.prepare');
    Route::get('/checkout',                    [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout',                   [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/payment/{order}',    [CheckoutController::class, 'paymentInstruction'])->name('checkout.payment');
    Route::post('/checkout/check-payment/{order}', [CheckoutController::class, 'checkPayment'])->name('checkout.check-payment');
    Route::get('/checkout/success/{order}',    [CheckoutController::class, 'success'])->name('checkout.success');
});

// ── Admin Routes ─────────────────────────────────────────────
Route::prefix('admin')
    ->middleware(['auth', CheckSessionExpiry::class, CheckAdminRole::class])
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', function () {
        $recentUsers = User::latest()->take(10)->get();
        $stats = [
            'total_users'   => User::count(),
            'orders_today'  => \App\Models\Order::where('status', 'paid')
                                ->whereDate('paid_at', today())
                                ->count(),
            'revenue_today' => \App\Models\Order::where('status', 'paid')
                                ->whereDate('paid_at', today())
                                ->sum('total_price'),
            'total_menu'    => \App\Models\Menu::where('is_active', true)->count(),
        ];
        return view('admin.dashboard', compact('stats', 'recentUsers'));
    })->name('dashboard');

    Route::get('/menu',                   [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/create',             [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu',                   [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{menu}/edit',        [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{menu}',             [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menu}',          [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::patch('/menu/{menu}/toggle',    [MenuController::class, 'toggleActive'])->name('menu.toggle');

    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('orders');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');

    Route::get('/users', function () {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    })->name('users');
});

require __DIR__.'/auth.php';
