<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout | Coffe Umat</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    {{-- Midtrans Snap JS (Sandbox) --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
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
        @keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.4s ease forwards; }
        .type-card input[type="radio"] { display: none; }
        .type-card label {
            display: flex; flex-direction: column; align-items: center; gap: 6px;
            padding: 14px; border-radius: 14px; border: 2px solid #e7d9d0;
            cursor: pointer; transition: all .2s; position: relative;
        }
        .type-card input:checked ~ label { border-color: #cf6317; background: #fef3ea; }
        .type-card label:hover { border-color: #cf631760; }
        .dot-check { display: none; position: absolute; top: 8px; right: 8px;
            width: 10px; height: 10px; border-radius: 50%; background: #cf6317; }
        .type-card input:checked ~ label .dot-check { display: block; }
    </style>
</head>
<body class="bg-coffee-50 text-slate-900 min-h-screen">

    {{-- Header --}}
    <header class="bg-white border-b border-coffee-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-coffee-900 hover:text-primary transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span class="font-bold text-sm">Kembali ke Menu</span>
            </a>
            <div class="flex items-center gap-2">
                <i data-lucide="coffee" class="w-5 h-5 text-primary"></i>
                <span class="font-black text-lg text-coffee-900">Coffe Umat</span>
            </div>
            <div class="w-28"></div>
        </div>
    </header>

    {{-- Progress --}}
    <div class="bg-white border-b border-coffee-100">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center gap-3 text-xs font-semibold">
            <div class="flex items-center gap-1.5 text-primary/50">
                <div class="w-5 h-5 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-black">✓</div>
                Pilih Menu
            </div>
            <div class="flex-1 h-px bg-primary/30"></div>
            <div class="flex items-center gap-1.5 text-primary font-black">
                <div class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-black">2</div>
                Checkout
            </div>
            <div class="flex-1 h-px bg-coffee-200"></div>
            <div class="flex items-center gap-1.5 text-slate-400">
                <div class="w-5 h-5 rounded-full bg-coffee-200 text-slate-400 flex items-center justify-center text-[10px] font-black">3</div>
                Selesai
            </div>
        </div>
    </div>

    <main class="max-w-5xl mx-auto px-4 py-8">

        @if(session('error'))
        <div class="mb-5 p-4 rounded-xl bg-red-50 text-red-700 border border-red-200 flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
            <p class="font-semibold text-sm">{{ session('error') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ── KIRI: Form ──────────────────────────────────── --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Info Pemesan --}}
                <div class="bg-white rounded-2xl border border-coffee-200 p-5 fade-up">
                    <h2 class="font-black text-coffee-900 mb-3 flex items-center gap-2 text-sm">
                        <i data-lucide="user" class="w-4 h-4 text-primary"></i>
                        Informasi Pemesan
                    </h2>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-coffee-50 border border-coffee-100">
                        <div class="w-10 h-10 rounded-full bg-primary/20 text-primary flex items-center justify-center font-black text-base">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm text-coffee-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Tipe Pesanan --}}
                <div class="bg-white rounded-2xl border border-coffee-200 p-5 fade-up" style="animation-delay:.05s">
                    <h2 class="font-black text-coffee-900 mb-4 flex items-center gap-2 text-sm">
                        <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
                        Tipe Pesanan
                    </h2>
                    <div class="grid grid-cols-2 gap-3" id="order-type-group">
                        <div class="type-card">
                            <input type="radio" name="order_type" id="dine-in" value="dine-in" checked>
                            <label for="dine-in">
                                <div class="dot-check"></div>
                                <i data-lucide="utensils" class="w-6 h-6 text-primary"></i>
                                <span class="font-bold text-sm">Makan di Sini</span>
                                <span class="text-xs text-slate-400">Dine-in</span>
                            </label>
                        </div>
                        <div class="type-card">
                            <input type="radio" name="order_type" id="takeaway" value="takeaway">
                            <label for="takeaway">
                                <div class="dot-check"></div>
                                <i data-lucide="package" class="w-6 h-6 text-primary"></i>
                                <span class="font-bold text-sm">Bawa Pulang</span>
                                <span class="text-xs text-slate-400">Takeaway</span>
                            </label>
                        </div>
                    </div>
                </div>



            </div>

            {{-- ── KANAN: Ringkasan ────────────────────────────── --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-coffee-200 p-5 sticky top-24 fade-up" style="animation-delay:.15s">
                    <h2 class="font-black text-coffee-900 mb-4 flex items-center gap-2 text-sm">
                        <i data-lucide="shopping-bag" class="w-4 h-4 text-primary"></i>
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-2.5 mb-4 max-h-52 overflow-y-auto pr-1">
                        @foreach($cart as $item)
                        <div class="flex items-start gap-2">
                            <div class="w-8 h-8 rounded-lg bg-coffee-50 border border-coffee-100 flex-shrink-0 overflow-hidden">
                                @if(!empty($item['img']))
                                <img src="{{ $item['img'] }}" alt="" class="w-full h-full object-cover"
                                     onerror="this.outerHTML='<div class=\'flex items-center justify-center h-full text-sm\'>☕</div>'">
                                @else
                                <div class="flex items-center justify-center h-full text-sm">☕</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-xs text-coffee-900 leading-tight truncate">{{ $item['name'] }}</p>
                                <p class="text-[11px] text-slate-400">{{ $item['qty'] }}× Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <p class="text-xs font-black text-primary whitespace-nowrap">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-coffee-100 pt-3 space-y-1.5">
                        <div class="flex justify-between text-xs text-slate-500">
                            <span>Subtotal</span>
                            <span class="font-semibold text-slate-700">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500">
                            <span>Pajak (8%)</span>
                            <span class="font-semibold text-slate-700">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-black text-base pt-2 border-t border-coffee-100">
                            <span>Total Bayar</span>
                            <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Estimasi poin --}}
                    @php $estimatedPts = max(1, (int) floor($total / 1000)); @endphp
                    <div class="mt-3 p-2.5 rounded-xl bg-amber-50 border border-amber-200 flex items-center gap-2">
                        <span class="text-base">⭐</span>
                        <p class="text-xs text-amber-700">Kamu mendapat <span class="font-black text-amber-800">+{{ $estimatedPts }} poin</span> dari transaksi ini!</p>
                    </div>

                    {{-- Tombol Bayar --}}
                    <button id="pay-btn" onclick="processPayment()"
                        class="mt-4 w-full py-3.5 bg-primary text-white font-black rounded-xl hover:bg-primary/90
                               shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2.5 text-sm">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                        Bayar Sekarang
                    </button>
                    <div class="flex items-center justify-center gap-1.5 mt-2.5">
                        <i data-lucide="shield" class="w-3 h-3 text-slate-400"></i>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Powered by Midtrans</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

<script>
// ── Proses pembayaran via Midtrans Snap ───────────────────────────
async function processPayment() {
    const btn = document.getElementById('pay-btn');
    const orderType = document.querySelector('input[name="order_type"]:checked')?.value;

    if (!orderType) { alert('Pilih tipe pesanan terlebih dahulu.'); return; }

    btn.disabled = true;
    btn.innerHTML = `<svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
    </svg> Memproses...`;

    try {
        const res = await fetch('{{ route('checkout.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ order_type: orderType }),
        });

        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || 'Gagal memproses pesanan.');

        // Buka popup Midtrans Snap
        snap.pay(data.snap_token, {
            onSuccess:  () => { window.location.href = data.success_url; },
            onPending:  () => { window.location.href = data.success_url; },
            onError:    () => { alert('Pembayaran gagal. Silakan coba lagi.'); resetBtn(); },
            onClose:    resetBtn,
        });

    } catch(err) {
        console.error(err);
        alert('Terjadi kesalahan: ' + err.message);
        resetBtn();
    }
}

function resetBtn() {
    const btn = document.getElementById('pay-btn');
    btn.disabled = false;
    btn.innerHTML = `<i data-lucide="lock" class="w-4 h-4"></i> Bayar Sekarang`;
    lucide.createIcons();
}

lucide.createIcons();
</script>
</body>
</html>
