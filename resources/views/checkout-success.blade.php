<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pesanan Berhasil | Coffe Umat</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#cf6317",
                        "coffee-900": "#1b130e",
                        "coffee-700": "#4a3728",
                        "coffee-200": "#e7d9d0",
                        "coffee-50":  "#f3ece7",
                    },
                    fontFamily: { "sans": ["Be Vietnam Pro", "sans-serif"] },
                },
            },
        }
    </script>
    <style>
        body { font-family: "Be Vietnam Pro", sans-serif; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        @keyframes scaleIn { from { opacity:0; transform:scale(0.5); } to { opacity:1; transform:scale(1); } }
        @keyframes checkStroke {
            from { stroke-dashoffset: 100; }
            to   { stroke-dashoffset: 0; }
        }
        .fade-up { animation: fadeUp 0.5s ease forwards; }
        .scale-in { animation: scaleIn 0.4s cubic-bezier(0.175,0.885,0.32,1.275) forwards; }
        .check-stroke { stroke-dasharray: 100; animation: checkStroke 0.6s 0.3s ease forwards; stroke-dashoffset: 100; }
        .info-chip { @apply flex items-center gap-2 px-4 py-2 rounded-full bg-white border  text-sm font-semibold ; }
    </style>
</head>
<body class="bg-coffee-50 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="bg-white border-b border-coffee-200">
        <div class="max-w-2xl mx-auto px-4 py-4 flex items-center justify-center gap-2">
            <i data-lucide="coffee" class="w-5 h-5 text-primary"></i>
            <span class="font-black text-lg text-coffee-900">Coffe Umat</span>
        </div>
    </header>

    {{-- Progress Steps --}}
    <div class="bg-white border-b border-coffee-100">
        <div class="max-w-2xl mx-auto px-4 py-3 flex items-center gap-3 text-xs font-semibold">
            <div class="flex items-center gap-1.5 text-slate-400">
                <div class="w-5 h-5 rounded-full bg-coffee-200 flex items-center justify-center text-[10px]">1</div>
                Pilih Menu
            </div>
            <div class="flex-1 h-px bg-primary/30"></div>
            <div class="flex items-center gap-1.5 text-slate-400">
                <div class="w-5 h-5 rounded-full bg-coffee-200 flex items-center justify-center text-[10px]">2</div>
                Checkout
            </div>
            <div class="flex-1 h-px bg-primary"></div>
            <div class="flex items-center gap-1.5 text-primary font-black">
                <div class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-black">✓</div>
                Selesai
            </div>
        </div>
    </div>

    <main class="flex-1 flex items-start justify-center py-10 px-4">
        <div class="w-full max-w-lg space-y-5">

            {{-- Success Card --}}
            <div class="bg-white rounded-2xl border border-coffee-200 p-8 text-center fade-up">
                {{-- Icon Animasi --}}
                <div class="flex justify-center mb-5">
                    <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center scale-in">
                        <svg class="w-10 h-10 text-green-500" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="25" cy="25" r="23" stroke="#22c55e" stroke-width="2.5"/>
                            <polyline class="check-stroke" points="12,26 21,35 38,17" stroke="#22c55e" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                    </div>
                </div>

                <h1 class="text-2xl font-black text-coffee-900 mb-2">Pesanan Diterima! 🎉</h1>
                <p class="text-slate-500 text-sm">
                    @if($order->status === 'paid')
                        Pembayaran berhasil! Pesananmu sedang kami siapkan, {{ Auth::user()->name }}.
                    @else
                        Terima kasih {{ Auth::user()->name }}! Menunggu konfirmasi pembayaran.
                    @endif
                </p>

                {{-- Order ID --}}
                <div class="mt-5 p-3 rounded-xl bg-coffee-50 border border-coffee-100">
                    <p class="text-xs text-slate-400 mb-1">Nomor Order</p>
                    <p class="font-black text-coffee-900 text-sm tracking-widest uppercase">
                        #{{ strtoupper(substr($order->id, 0, 8)) }}
                    </p>
                    <p class="text-xs text-slate-400 mt-1">{{ $order->created_at?->format('d M Y, H:i') ?? now()->format('d M Y, H:i') }} WIB</p>
                </div>

                {{-- Chips Info --}}
                <div class="flex flex-wrap justify-center gap-2 mt-5">
                    <span class="info-chip">
                        @if($order->order_type === 'dine-in')
                            <i data-lucide="utensils" class="w-4 h-4 text-primary"></i> Makan di Sini
                        @else
                            <i data-lucide="package" class="w-4 h-4 text-primary"></i> Bawa Pulang
                        @endif
                    </span>
                    <span class="info-chip">
                        @if($order->payment_method === 'qris')
                            <span class="font-black text-xs text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded">QR</span> QRIS
                        @elseif($order->payment_method === 'transfer')
                            <i data-lucide="landmark" class="w-4 h-4 text-green-600"></i> Transfer Bank
                        @else
                            <i data-lucide="banknote" class="w-4 h-4 text-amber-600"></i> {{ ucfirst($order->payment_method) }}
                        @endif
                    </span>
                    <span class="info-chip">
                        @if($order->status === 'paid')
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Lunas
                        @elseif($order->status === 'pending')
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu Pembayaran
                        @else
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span> {{ ucfirst($order->status) }}
                        @endif
                    </span>
                </div>

                {{-- ⭐ Poin yang didapat --}}
                @if($order->status === 'paid' && $earnedPoints > 0)
                <div class="mt-5 p-4 rounded-xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="text-2xl">⭐</div>
                            <div>
                                <p class="font-black text-amber-800 text-sm">Poin Kamu Bertambah!</p>
                                <p class="text-xs text-amber-600">Total poin: <span class="font-bold">{{ number_format($totalPoints) }} pts</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-black text-amber-600">+{{ $earnedPoints }}</p>
                            <p class="text-xs text-amber-500 font-semibold">poin baru</p>
                        </div>
                    </div>
                    <div class="mt-2 bg-amber-100 rounded-lg p-2 text-center">
                        <p class="text-xs text-amber-700">💡 1 poin = Rp 1.000 transaksi · Tukarkan poin untuk diskon!</p>
                    </div>
                </div>
                @elseif($order->status === 'pending')
                <div class="mt-4 p-3 rounded-xl bg-amber-50 border border-amber-200 text-center">
                    <p class="text-xs text-amber-700 font-semibold">⏳ Poin akan diberikan setelah pembayaran dikonfirmasi</p>
                </div>
                @endif
            </div>

            {{-- Detail Item --}}
            <div class="bg-white rounded-2xl border border-coffee-200 p-5 fade-up" style="animation-delay:0.1s">
                <h3 class="font-black text-coffee-900 mb-4 text-sm flex items-center gap-2">
                    <i data-lucide="list" class="w-4 h-4 text-primary"></i>
                    Detail Pesanan
                </h3>
                <div class="space-y-3">
                    @foreach($items as $item)
                    <div class="flex justify-between items-center text-sm">
                        <div>
                            <p class="font-bold text-coffee-900">{{ $item->item_name ?? 'Menu' }}</p>
                            <p class="text-xs text-slate-400">{{ $item->quantity }}x · Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-black text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-coffee-100 mt-4 pt-4 flex justify-between font-black">
                    <span class="text-coffee-900">Total Bayar</span>
                    <span class="text-primary text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Info estimasi --}}
            <div class="bg-coffee-900 rounded-2xl p-5 text-white fade-up" style="animation-delay:0.2s">
                <div class="flex items-center gap-2 mb-3">
                    <i data-lucide="clock" class="w-4 h-4 text-primary"></i>
                    <p class="font-black text-sm">Estimasi Siap</p>
                </div>
                <p class="text-3xl font-black text-primary mb-1">15 – 20 <span class="text-base font-medium text-slate-300">menit</span></p>
                <p class="text-xs text-slate-400">Pesananmu sedang diproses oleh barista kami ☕</p>
            </div>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row gap-3 fade-up" style="animation-delay:0.25s">
                <a href="{{ route('dashboard') }}"
                   class="flex-1 py-3 rounded-xl bg-white border-2 border-coffee-200 text-coffee-900 font-bold text-sm text-center hover:bg-coffee-50 transition flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Pesan Lagi
                </a>
                <a href="{{ route('dashboard') }}"
                   class="flex-1 py-3 rounded-xl bg-primary text-white font-black text-sm text-center hover:bg-primary/90 transition shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </main>

<script>lucide.createIcons();</script>
</body>
</html>
