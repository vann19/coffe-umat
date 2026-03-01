<x-layouts.public title="Menu | Coffe Umat">

    <!-- Header -->
    <section class="px-4 md:px-20 py-8 md:py-12 bg-coffee-900">
        <div class="max-w-6xl mx-auto">
            <span class="text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm">Pilihan Kami</span>
            <h1 class="text-white text-3xl md:text-5xl font-black mt-2 mb-3">Menu Kopi</h1>
            <p class="text-slate-300 text-sm md:text-lg max-w-2xl">Temukan pilihan kopi dan makanan terbaik kami, dibuat dengan bahan pilihan setiap hari.</p>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="px-4 md:px-20 py-4 border-b border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/10">
        <div class="max-w-6xl mx-auto flex gap-2 md:gap-3 overflow-x-auto pb-1 scrollbar-none">
            <button class="px-4 md:px-5 py-2 rounded-full bg-primary text-white font-semibold text-xs md:text-sm whitespace-nowrap flex-shrink-0">Semua</button>
            <button class="px-4 md:px-5 py-2 rounded-full border border-coffee-200 dark:border-coffee-700 text-coffee-700 dark:text-slate-300 font-semibold text-xs md:text-sm hover:border-primary hover:text-primary transition-colors whitespace-nowrap flex-shrink-0">☕ Kopi</button>
            <button class="px-4 md:px-5 py-2 rounded-full border border-coffee-200 dark:border-coffee-700 text-coffee-700 dark:text-slate-300 font-semibold text-xs md:text-sm hover:border-primary hover:text-primary transition-colors whitespace-nowrap flex-shrink-0">🥤 Non-Kopi</button>
            <button class="px-4 md:px-5 py-2 rounded-full border border-coffee-200 dark:border-coffee-700 text-coffee-700 dark:text-slate-300 font-semibold text-xs md:text-sm hover:border-primary hover:text-primary transition-colors whitespace-nowrap flex-shrink-0">🍞 Makanan</button>
        </div>
    </section>

    <section class="px-4 md:px-20 py-8 md:py-12">
        <div class="max-w-6xl mx-auto">

            <h2 class="text-xl md:text-2xl font-black text-coffee-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                <i data-lucide="coffee" class="w-5 h-5 md:w-6 md:h-6 text-primary"></i> Kopi
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-10 md:mb-12">
                @foreach([
                    ['Espresso', 'Biji arabika pilihan, diseduh sempurna.', 'Rp 25.000', 'coffee'],
                    ['Cappuccino', 'Espresso dengan susu panas dan busa lembut.', 'Rp 35.000', 'cup-saucer'],
                    ['Latte Art', 'Espresso dengan susu steamed dan seni latte.', 'Rp 38.000', 'droplets'],
                    ['Cold Brew', 'Kopi dingin diseduh 12 jam, nikmat segar.', 'Rp 32.000', 'thermometer-snowflake'],
                    ['Americano', 'Espresso dengan tambahan air panas.', 'Rp 28.000', 'glass-water'],
                    ['Flat White', 'Espresso kuat dengan susu microfoam tipis.', 'Rp 36.000', 'milk'],
                ] as $item)
                <div class="group rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all">
                    <div class="h-28 md:h-40 bg-gradient-to-br from-coffee-700 to-coffee-900 flex items-center justify-center">
                        <i data-lucide="{{ $item[3] }}" class="w-10 h-10 md:w-16 md:h-16 text-primary/50"></i>
                    </div>
                    <div class="p-3 md:p-5">
                        <div class="flex justify-between items-start mb-1 md:mb-2">
                            <h3 class="font-bold text-coffee-900 dark:text-slate-100 text-sm md:text-lg leading-tight">{{ $item[0] }}</h3>
                            <span class="font-black text-primary text-xs md:text-sm whitespace-nowrap ml-1">{{ $item[2] }}</span>
                        </div>
                        <p class="text-coffee-700 dark:text-slate-400 text-xs mb-3 leading-relaxed hidden md:block">{{ $item[1] }}</p>
                        <button class="w-full py-1.5 md:py-2 rounded-lg bg-primary/10 text-primary font-bold text-xs hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-1">
                            <i data-lucide="plus" class="w-3 h-3 md:w-4 md:h-4"></i> <span class="hidden sm:inline">Tambah ke</span> Keranjang
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <h2 class="text-xl md:text-2xl font-black text-coffee-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                <i data-lucide="cup-saucer" class="w-5 h-5 md:w-6 md:h-6 text-primary"></i> Non-Kopi
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-10 md:mb-12">
                @foreach([
                    ['Matcha Latte', 'Matcha premium Jepang dengan susu segar.', 'Rp 35.000', 'leaf'],
                    ['Cokelat Panas', 'Cokelat belgian premium yang kaya rasa.', 'Rp 30.000', 'heart'],
                    ['Teh Tarik', 'Teh hitam dengan susu kental manis tradisional.', 'Rp 22.000', 'droplets'],
                ] as $item)
                <div class="group rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all">
                    <div class="h-28 md:h-40 bg-gradient-to-br from-emerald-800 to-coffee-900 flex items-center justify-center">
                        <i data-lucide="{{ $item[3] }}" class="w-10 h-10 md:w-16 md:h-16 text-emerald-400/50"></i>
                    </div>
                    <div class="p-3 md:p-5">
                        <div class="flex justify-between items-start mb-1 md:mb-2">
                            <h3 class="font-bold text-coffee-900 dark:text-slate-100 text-sm md:text-lg leading-tight">{{ $item[0] }}</h3>
                            <span class="font-black text-primary text-xs md:text-sm whitespace-nowrap ml-1">{{ $item[2] }}</span>
                        </div>
                        <p class="text-coffee-700 dark:text-slate-400 text-xs mb-3 leading-relaxed hidden md:block">{{ $item[1] }}</p>
                        <button class="w-full py-1.5 md:py-2 rounded-lg bg-primary/10 text-primary font-bold text-xs hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-1">
                            <i data-lucide="plus" class="w-3 h-3 md:w-4 md:h-4"></i> <span class="hidden sm:inline">Tambah ke</span> Keranjang
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <h2 class="text-xl md:text-2xl font-black text-coffee-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                <i data-lucide="sandwich" class="w-5 h-5 md:w-6 md:h-6 text-primary"></i> Makanan
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach([
                    ['Croissant Mentega', 'Croissant renyah dengan mentega Prancis asli.', 'Rp 28.000', 'wheat'],
                    ['Roti Bakar Avokad', 'Roti sourdough dengan avokad segar dan telur.', 'Rp 45.000', 'sandwich'],
                    ['Kue Cokelat', 'Kue cokelat lembut dengan topping dark chocolate.', 'Rp 32.000', 'cake'],
                ] as $item)
                <div class="group rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all">
                    <div class="h-28 md:h-40 bg-gradient-to-br from-amber-800 to-coffee-900 flex items-center justify-center">
                        <i data-lucide="{{ $item[3] }}" class="w-10 h-10 md:w-16 md:h-16 text-amber-400/50"></i>
                    </div>
                    <div class="p-3 md:p-5">
                        <div class="flex justify-between items-start mb-1 md:mb-2">
                            <h3 class="font-bold text-coffee-900 dark:text-slate-100 text-sm md:text-lg leading-tight">{{ $item[0] }}</h3>
                            <span class="font-black text-primary text-xs md:text-sm whitespace-nowrap ml-1">{{ $item[2] }}</span>
                        </div>
                        <p class="text-coffee-700 dark:text-slate-400 text-xs mb-3 leading-relaxed hidden md:block">{{ $item[1] }}</p>
                        <button class="w-full py-1.5 md:py-2 rounded-lg bg-primary/10 text-primary font-bold text-xs hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-1">
                            <i data-lucide="plus" class="w-3 h-3 md:w-4 md:h-4"></i> <span class="hidden sm:inline">Tambah ke</span> Keranjang
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.public>
