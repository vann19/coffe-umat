<x-layouts.public title="Rewards | Coffe Umat">

    <section class="px-4 md:px-20 py-8 md:py-12 bg-coffee-900">
        <div class="max-w-6xl mx-auto">
            <span class="text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm">Program Loyalitas</span>
            <h1 class="text-white text-3xl md:text-5xl font-black mt-2 mb-3">Artisan Rewards</h1>
            <p class="text-slate-300 text-sm md:text-lg max-w-2xl">Setiap cangkir kopi adalah poin untukmu. Kumpulkan dan tukarkan dengan hadiah eksklusif!</p>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section class="px-4 md:px-20 py-10 md:py-16 bg-coffee-50 dark:bg-coffee-900/30">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-black text-coffee-900 dark:text-slate-100 mb-2 text-center">Cara Kerja</h2>
            <div class="h-1.5 w-20 bg-primary rounded-full mb-8 md:mb-12 mx-auto"></div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 md:gap-8">
                @foreach([
                    ['1', 'Daftar Akun', 'Buat akun gratis di Coffe Umat dan mulailah perjalanan reward-mu.', 'user-plus'],
                    ['2', 'Beli & Kumpulkan', 'Setiap Rp 1.000 pembelian = 1 poin. Semakin banyak beli, semakin banyak poin.', 'star'],
                    ['3', 'Tukarkan', 'Tukarkan poin dengan minuman gratis, diskon, atau merchandise eksklusif.', 'gift'],
                ] as $step)
                <div class="flex flex-col items-center text-center gap-3 md:gap-4 p-6 md:p-8 rounded-xl bg-white dark:bg-coffee-900/40 border border-coffee-200 dark:border-coffee-700/50 shadow-sm">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-primary flex items-center justify-center text-white font-black text-xl md:text-2xl shadow-lg shadow-primary/30">{{ $step[0] }}</div>
                    <i data-lucide="{{ $step[3] }}" class="w-8 h-8 md:w-10 md:h-10 text-primary"></i>
                    <h3 class="text-lg md:text-xl font-bold text-coffee-900 dark:text-slate-100">{{ $step[1] }}</h3>
                    <p class="text-coffee-700 dark:text-slate-400 leading-relaxed text-sm">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Level Member -->
    <section class="px-4 md:px-20 py-10 md:py-16">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-black text-coffee-900 dark:text-slate-100 mb-2">Level Member</h2>
            <div class="h-1.5 w-20 bg-primary rounded-full mb-8 md:mb-10"></div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 md:gap-6">

                <div class="rounded-xl border-2 border-amber-600/30 bg-white dark:bg-coffee-900/20 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-5">
                        <i data-lucide="award" class="w-8 h-8 md:w-10 md:h-10 text-amber-600"></i>
                        <div>
                            <p class="font-black text-lg md:text-xl text-amber-700 dark:text-amber-500">Bronze</p>
                            <p class="text-xs md:text-sm text-coffee-700 dark:text-slate-400">0 - 499 poin</p>
                        </div>
                    </div>
                    <ul class="space-y-2 md:space-y-3 text-coffee-700 dark:text-slate-400 text-xs md:text-sm mb-5">
                        @foreach(['Poin x1 setiap pembelian', 'Hadiah ulang tahun', 'Akses menu eksklusif member', 'Newsletter mingguan'] as $b)
                        <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-3.5 h-3.5 text-amber-600 flex-shrink-0"></i> {{ $b }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center py-2.5 rounded-lg border-2 border-amber-600 text-amber-700 dark:text-amber-500 font-bold text-sm hover:bg-amber-600 hover:text-white transition-colors">Mulai Gratis</a>
                </div>

                <div class="rounded-xl border-2 border-slate-400/50 bg-white dark:bg-coffee-900/20 p-6 md:p-8 relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-slate-500 text-white text-xs font-bold px-4 py-1 rounded-full">POPULER</div>
                    <div class="flex items-center gap-3 mb-5">
                        <i data-lucide="shield-check" class="w-8 h-8 md:w-10 md:h-10 text-slate-500"></i>
                        <div>
                            <p class="font-black text-lg md:text-xl text-slate-600 dark:text-slate-300">Silver</p>
                            <p class="text-xs md:text-sm text-coffee-700 dark:text-slate-400">500 - 1.999 poin</p>
                        </div>
                    </div>
                    <ul class="space-y-2 md:space-y-3 text-coffee-700 dark:text-slate-400 text-xs md:text-sm mb-5">
                        @foreach(['Poin x1.5 setiap pembelian', 'Hadiah ulang tahun double', 'Diskon 10% setiap pembelian', '1 minuman gratis per bulan', 'Priority queue saat ramai'] as $b)
                        <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-3.5 h-3.5 text-slate-500 flex-shrink-0"></i> {{ $b }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center py-2.5 rounded-lg bg-slate-500 text-white font-bold text-sm hover:bg-slate-600 transition-colors">Capai Silver</a>
                </div>

                <div class="rounded-xl border-2 border-yellow-500/50 bg-gradient-to-b from-yellow-50 to-white dark:from-yellow-900/10 dark:to-coffee-900/20 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-5">
                        <i data-lucide="crown" class="w-8 h-8 md:w-10 md:h-10 text-yellow-500"></i>
                        <div>
                            <p class="font-black text-lg md:text-xl text-yellow-600 dark:text-yellow-400">Gold</p>
                            <p class="text-xs md:text-sm text-coffee-700 dark:text-slate-400">2.000+ poin</p>
                        </div>
                    </div>
                    <ul class="space-y-2 md:space-y-3 text-coffee-700 dark:text-slate-400 text-xs md:text-sm mb-5">
                        @foreach(['Poin x2 setiap pembelian', 'Hadiah ulang tahun spesial', 'Diskon 20% setiap pembelian', '3 minuman gratis per bulan', 'Early access menu baru', 'Undangan event eksklusif'] as $b)
                        <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-3.5 h-3.5 text-yellow-500 flex-shrink-0"></i> {{ $b }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center py-2.5 rounded-lg bg-yellow-500 text-white font-bold text-sm hover:bg-yellow-600 transition-colors">Raih Gold</a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="px-4 md:px-20 py-12 md:py-16 bg-coffee-900">
        <div class="max-w-2xl mx-auto text-center">
            <i data-lucide="gift" class="w-10 h-10 md:w-14 md:h-14 text-primary mb-4 mx-auto"></i>
            <h2 class="text-2xl md:text-3xl font-black text-white mb-3 md:mb-4">Mulai Kumpulkan Poin Sekarang!</h2>
            <p class="text-slate-300 text-sm md:text-base mb-6 md:mb-8">Daftar gratis dan dapatkan 100 poin selamat datang untuk pesanan pertamamu.</p>
            <a href="{{ route('register') }}" class="inline-block px-8 md:px-10 py-3 md:py-4 rounded-lg bg-primary text-white font-bold text-base md:text-lg hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/30">
                Daftar & Dapatkan 100 Poin 🎁
            </a>
        </div>
    </section>

</x-layouts.public>
