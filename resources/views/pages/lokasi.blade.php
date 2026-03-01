<x-layouts.public title="Lokasi | Coffe Umat">

    <section class="px-4 md:px-20 py-8 md:py-12 bg-coffee-900">
        <div class="max-w-6xl mx-auto">
            <span class="text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm">Temukan Kami</span>
            <h1 class="text-white text-3xl md:text-5xl font-black mt-2 mb-3">Lokasi Kami</h1>
            <p class="text-slate-300 text-sm md:text-lg max-w-2xl">Kunjungi kedai terdekat kami dan rasakan langsung pengalaman kopi Coffe Umat.</p>
        </div>
    </section>

    <section class="px-4 md:px-20 py-10 md:py-16">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-8">
                @foreach([
                    ['Coffe Umat Pusat', 'Jl. Sudirman No. 88, Jakarta Pusat, DKI Jakarta 10220', 'Sen - Jum: 07.00 - 22.00', 'Sab - Min: 08.00 - 23.00', '(021) 1234-5678'],
                    ['Coffe Umat Selatan', 'Jl. TB Simatupang No. 12, Jakarta Selatan, DKI Jakarta 12520', 'Sen - Jum: 07.00 - 21.00', 'Sab - Min: 08.00 - 22.00', '(021) 8765-4321'],
                    ['Coffe Umat Bandung', 'Jl. Dago No. 45, Coblong, Bandung, Jawa Barat 40135', 'Sen - Jum: 08.00 - 21.00', 'Sab - Min: 09.00 - 22.00', '(022) 2345-6789'],
                    ['Coffe Umat Yogyakarta', 'Jl. Malioboro No. 123, Gedongtengen, Yogyakarta 55271', 'Sen - Jum: 07.30 - 21.30', 'Sab - Min: 08.00 - 22.30', '(0274) 345-6789'],
                ] as $loc)
                <div class="rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all">
                    <div class="h-36 md:h-48 bg-gradient-to-br from-coffee-200 to-coffee-700 flex items-center justify-center relative overflow-hidden">
                        <i data-lucide="map" class="w-24 h-24 md:w-32 md:h-32 text-coffee-900/10 absolute"></i>
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <i data-lucide="map-pin" class="w-8 h-8 md:w-10 md:h-10 text-primary"></i>
                            <span class="text-white font-bold text-xs md:text-sm bg-coffee-900/60 px-3 py-1 rounded-full backdrop-blur text-center">{{ $loc[0] }}</span>
                        </div>
                    </div>
                    <div class="p-4 md:p-6 flex flex-col gap-3 md:gap-4">
                        <h3 class="text-base md:text-xl font-black text-coffee-900 dark:text-slate-100">{{ $loc[0] }}</h3>
                        <div class="flex gap-2 md:gap-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary mt-0.5 flex-shrink-0"></i>
                            <p class="text-coffee-700 dark:text-slate-400 text-xs md:text-sm leading-relaxed">{{ $loc[1] }}</p>
                        </div>
                        <div class="flex gap-2 md:gap-3">
                            <i data-lucide="clock" class="w-4 h-4 text-primary mt-0.5 flex-shrink-0"></i>
                            <div class="text-xs md:text-sm text-coffee-700 dark:text-slate-400">
                                <p>{{ $loc[2] }}</p>
                                <p>{{ $loc[3] }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2 md:gap-3">
                            <i data-lucide="phone" class="w-4 h-4 text-primary mt-0.5 flex-shrink-0"></i>
                            <p class="text-coffee-700 dark:text-slate-400 text-xs md:text-sm">{{ $loc[4] }}</p>
                        </div>
                        <a href="#" class="mt-1 flex items-center justify-center gap-2 w-full py-2 md:py-2.5 rounded-lg bg-primary/10 text-primary font-bold text-xs md:text-sm hover:bg-primary hover:text-white transition-colors">
                            <i data-lucide="navigation" class="w-3.5 h-3.5"></i> Petunjuk Arah
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.public>
