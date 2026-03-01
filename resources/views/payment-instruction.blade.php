<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instruksi Pembayaran | Coffe Umat</title>
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
                        "coffee-200": "#e7d9d0",
                        "coffee-50": "#f3ece7",
                    },
                    fontFamily: { "sans": ["Be Vietnam Pro", "sans-serif"] },
                },
            },
        }
    </script>
    <style>
        body { font-family: "Be Vietnam Pro", sans-serif; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.45s ease forwards; }
        @keyframes pulse-ring { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.06);opacity:.7} }
        .pulse { animation: pulse-ring 2s ease-in-out infinite; }
        .copy-btn { transition: all .2s; }
        .copy-btn.copied { background: #16a34a; color: #fff; }
    </style>
</head>
<body class="bg-coffee-50 min-h-screen">

    {{-- Header --}}
    <header class="bg-white border-b border-coffee-200 sticky top-0 z-50">
        <div class="max-w-2xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-coffee-900 hover:text-primary transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span class="font-bold text-sm">Kembali</span>
            </a>
            <div class="flex items-center gap-2">
                <i data-lucide="coffee" class="w-5 h-5 text-primary"></i>
                <span class="font-black text-lg text-coffee-900">Coffe Umat</span>
            </div>
            <div class="w-20"></div>
        </div>
    </header>

    {{-- Progress --}}
    <div class="bg-white border-b border-coffee-100">
        <div class="max-w-2xl mx-auto px-4 py-3 flex items-center gap-3 text-xs font-semibold">
            <div class="flex items-center gap-1.5 text-primary/50">
                <div class="w-5 h-5 rounded-full bg-primary/20 flex items-center justify-center text-[10px] text-primary font-black">✓</div>
                Pilih Menu
            </div>
            <div class="flex-1 h-px bg-primary/30"></div>
            <div class="flex items-center gap-1.5 text-primary/50">
                <div class="w-5 h-5 rounded-full bg-primary/20 flex items-center justify-center text-[10px] text-primary font-black">✓</div>
                Checkout
            </div>
            <div class="flex-1 h-px bg-primary/50"></div>
            <div class="flex items-center gap-1.5 text-primary font-black">
                <div class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-black">3</div>
                Bayar
            </div>
            <div class="flex-1 h-px bg-coffee-200"></div>
            <div class="flex items-center gap-1.5 text-slate-400">
                <div class="w-5 h-5 rounded-full bg-coffee-200 text-slate-500 flex items-center justify-center text-[10px] font-black">4</div>
                Selesai
            </div>
        </div>
    </div>

    <main class="max-w-2xl mx-auto px-4 py-8 space-y-4">

        {{-- Status banner --}}
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-center gap-3 fade-up">
            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 pulse">
                <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
            </div>
            <div class="flex-1">
                <p class="font-black text-amber-800 text-sm">Menunggu Pembayaran</p>
                <p class="text-xs text-amber-600">Order <span class="font-bold">#{{ strtoupper(substr($order->id, 0, 8)) }}</span> · Selesaikan sebelum masa berlaku habis</p>
            </div>
        </div>

        {{-- Jumlah yang harus dibayar --}}
        <div class="bg-white rounded-2xl border border-coffee-200 p-5 fade-up text-center">
            <p class="text-sm text-slate-400 mb-1">Total yang harus dibayar</p>
            <p class="text-4xl font-black text-primary tracking-tight">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        {{-- VA Number Card --}}
        @php
            $bankInfo = [
                'bca'     => ['name' => 'BCA Virtual Account',     'color' => 'bg-blue-600',   'icon' => '🏦', 'desc' => 'Bayar via m-BCA, KlikBCA, atau ATM BCA'],
                'bni'     => ['name' => 'BNI Virtual Account',     'color' => 'bg-orange-600', 'icon' => '🏦', 'desc' => 'Bayar via BNI Mobile, Internet Banking, atau ATM BNI'],
                'bri'     => ['name' => 'BRI Virtual Account',     'color' => 'bg-blue-800',   'icon' => '🏦', 'desc' => 'Bayar via BRImo, Internet Banking, atau ATM BRI'],
                'mandiri' => ['name' => 'Mandiri Bill Payment',    'color' => 'bg-yellow-600', 'icon' => '🏦', 'desc' => 'Bayar via Livin\' by Mandiri atau ATM Mandiri'],
                'permata' => ['name' => 'Permata Virtual Account', 'color' => 'bg-red-600',    'icon' => '🏦', 'desc' => 'Bayar via PermataMobile X atau ATM Permata'],
            ];
            $info = $bankInfo[$order->bank] ?? ['name' => strtoupper($order->bank), 'color' => 'bg-slate-600', 'icon' => '🏦', 'desc' => ''];
        @endphp

        <div class="bg-white rounded-2xl border border-coffee-200 overflow-hidden fade-up">
            {{-- Bank header --}}
            <div class="px-5 py-4 flex items-center gap-3 border-b border-coffee-100">
                <div class="text-2xl">{{ $info['icon'] }}</div>
                <div>
                    <p class="font-black text-coffee-900 text-sm">{{ $info['name'] }}</p>
                    <p class="text-xs text-slate-400">{{ $info['desc'] }}</p>
                </div>
            </div>

            <div class="p-5 space-y-4">
                @if($order->bank === 'mandiri')
                {{-- Mandiri: Biller Code + Pay Code --}}
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kode Perusahaan (Biller Code)</p>
                    <div class="flex items-center justify-between bg-coffee-50 border border-coffee-200 rounded-xl px-4 py-3">
                        <p class="font-black text-xl tracking-widest text-coffee-900" id="biller-code">{{ $order->biller_code ?? '-' }}</p>
                        <button onclick="copyText('biller-code', this)" class="copy-btn px-3 py-1.5 rounded-lg bg-primary/10 text-primary text-xs font-bold hover:bg-primary hover:text-white">
                            Salin
                        </button>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kode Bayar (Pay Code)</p>
                    <div class="flex items-center justify-between bg-coffee-50 border border-coffee-200 rounded-xl px-4 py-3">
                        <p class="font-black text-2xl tracking-widest text-coffee-900" id="va-number">{{ $order->va_number ?? '-' }}</p>
                        <button onclick="copyText('va-number', this)" class="copy-btn px-3 py-1.5 rounded-lg bg-primary/10 text-primary text-xs font-bold hover:bg-primary hover:text-white">
                            Salin
                        </button>
                    </div>
                </div>

                @else
                {{-- Bank lain: VA Number --}}
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nomor Virtual Account</p>
                    <div class="flex items-center justify-between bg-coffee-50 border border-coffee-200 rounded-xl px-4 py-3">
                        <p class="font-black text-2xl tracking-widest text-coffee-900 tabular-nums" id="va-number">{{ $order->va_number ?? '-' }}</p>
                        <button onclick="copyText('va-number', this)" class="copy-btn px-3 py-1.5 rounded-lg bg-primary/10 text-primary text-xs font-bold hover:bg-primary hover:text-white">
                            Salin
                        </button>
                    </div>
                    <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                        <i data-lucide="info" class="w-3 h-3"></i>
                        Nomor VA unik untuk pesanan ini saja. Berlaku 24 jam.
                    </p>
                </div>
                @endif

                {{-- Cara pembayaran --}}
                @php
                    $steps = [
                        'bca'     => ['Buka m-BCA / KlikBCA', 'Pilih menu Pembayaran > Virtual Account', 'Masukkan nomor VA di atas', 'Konfirmasi jumlah dan selesaikan'],
                        'bni'     => ['Buka BNI Mobile Banking', 'Pilih Transfer > Virtual Account Billing', 'Masukkan nomor VA di atas', 'Verifikasi dan konfirmasi'],
                        'bri'     => ['Buka BRImo', 'Pilih Beli / Bayar > BRIVA', 'Masukkan nomor VA di atas', 'Konfirmasi pembayaran'],
                        'mandiri' => ['Buka Livin\' by Mandiri', 'Pilih Bayar > Mandiri Virtual Account', 'Masukkan Kode Perusahaan & Kode Bayar', 'Konfirmasi jumlah dan selesaikan'],
                        'permata' => ['Buka PermataMobile X atau ATM Permata', 'Pilih Bayar Tagihan > Virtual Account', 'Masukkan nomor VA di atas', 'Konfirmasi pembayaran'],
                    ];
                    $bankSteps = $steps[$order->bank] ?? [];
                @endphp

                @if(!empty($bankSteps))
                <div class="border-t border-coffee-100 pt-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Cara Pembayaran</p>
                    <ol class="space-y-2">
                        @foreach($bankSteps as $i => $step)
                        <li class="flex items-start gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[10px] font-black flex items-center justify-center flex-shrink-0 mt-0.5">{{ $i + 1 }}</span>
                            <span class="text-sm text-slate-600">{{ $step }}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
                @endif
            </div>
        </div>

        {{-- Ringkasan pesanan --}}
        <div class="bg-white rounded-2xl border border-coffee-200 p-5 fade-up">
            <p class="font-black text-coffee-900 text-sm mb-3 flex items-center gap-2">
                <i data-lucide="shopping-bag" class="w-4 h-4 text-primary"></i>
                Pesanan Kamu
            </p>
            <div class="space-y-2">
                @foreach($items as $item)
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-600">{{ $item->quantity }}× {{ $item->item_name }}</span>
                    <span class="font-semibold text-slate-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <div class="flex justify-between items-center pt-2 border-t border-coffee-100 font-black">
                    <span>Total</span>
                    <span class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Tombol Cek Pembayaran --}}
        <button id="check-btn" onclick="checkPaymentStatus()"
            class="w-full py-4 bg-primary text-white font-black rounded-xl hover:bg-primary/90 shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2.5 text-sm fade-up">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
            Saya Sudah Bayar — Cek Status
        </button>

        <p class="text-center text-xs text-slate-400 fade-up">
            Pembayaran otomatis dikonfirmasi. Klik tombol di atas setelah selesai transfer.
        </p>

    </main>

<script>
// ── Copy to clipboard ────────────────────────────────────────────
function copyText(elementId, btn) {
    const text = document.getElementById(elementId).innerText;
    navigator.clipboard.writeText(text).then(() => {
        btn.textContent = '✓ Tersalin!';
        btn.classList.add('copied');
        setTimeout(() => {
            btn.textContent = 'Salin';
            btn.classList.remove('copied');
        }, 2000);
    });
}

// ── Cek status pembayaran ke Midtrans API ─────────────────────────
async function checkPaymentStatus() {
    const btn = document.getElementById('check-btn');
    btn.disabled = true;
    btn.innerHTML = `<svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
    </svg> Memeriksa pembayaran...`;

    try {
        const res  = await fetch('{{ route('checkout.check-payment', $order->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        });
        const data = await res.json();

        if (data.is_paid && data.redirect) {
            btn.innerHTML = `✅ Pembayaran Dikonfirmasi! Mengalihkan...`;
            btn.classList.add('bg-green-600');
            setTimeout(() => { window.location.href = data.redirect; }, 1200);
        } else {
            btn.disabled = false;
            btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582M20 20v-5h-.581M5.635 15A9 9 0 1018.364 9"/></svg> Belum terdeteksi. Coba lagi`;
            btn.classList.remove('opacity-50');
        }
    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582M20 20v-5h-.581M5.635 15A9 9 0 1018.364 9"/></svg> Cek Ulang Status`;
    }
}

lucide.createIcons();
</script>
</body>
</html>
