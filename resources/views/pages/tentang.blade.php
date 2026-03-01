<x-layouts.public title="Tentang Kami | Coffe Umat">

    <section class="px-4 md:px-20 py-12 bg-coffee-900">
        <div class="max-w-6xl mx-auto">
            <span class="text-primary font-bold tracking-[0.2em] uppercase text-sm">Kisah Kami</span>
            <h1 class="text-white text-4xl md:text-5xl font-black mt-2 mb-4">Tentang Coffe Umat</h1>
            <p class="text-slate-300 text-lg max-w-2xl">Berawal dari satu cangkir kopi sederhana, kami tumbuh menjadi komunitas pecinta kopi yang bersemangat.</p>
        </div>
    </section>

    <section class="px-4 md:px-20 py-16">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center mb-20">
                <div>
                    <span class="text-primary font-bold tracking-widest uppercase text-sm">Perjalanan Kami</span>
                    <h2 class="text-3xl md:text-4xl font-black text-coffee-900 dark:text-slate-100 mt-3 mb-6">Dimulai dari Rasa Cinta</h2>
                    <div class="space-y-4 text-coffee-700 dark:text-slate-400 leading-relaxed">
                        <p>Coffe Umat lahir pada tahun 2015 dari sebuah garasi kecil di Jakarta. Pendiri kami, Budi Santoso, adalah seorang pecinta kopi yang frustrasi dengan kopi generik yang ada di pasaran.</p>
                        <p>Dengan berbekal keahlian sangrai otodidak dan tekad yang kuat, ia mulai bereksperimen dengan biji kopi dari berbagai penjuru Nusantara — dari lereng Gunung Bromo hingga dataran tinggi Aceh.</p>
                        <p>Kini, hampir satu dekade kemudian, Coffe Umat telah hadir di 4 kota dengan lebih dari 50 karyawan yang berbagi semangat yang sama: menyajikan secangkir kopi sempurna setiap saat.</p>
                    </div>
                </div>
                <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-coffee-700 to-coffee-900 h-80 flex items-center justify-center shadow-2xl">
                    <i data-lucide="coffee" class="w-32 h-32 text-primary/30"></i>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-black text-coffee-900 dark:text-slate-100 mb-2">Nilai-nilai Kami</h2>
                <div class="h-1.5 w-20 bg-primary rounded-full mb-10"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['heart-handshake', 'Komitmen Kualitas', 'Setiap cangkir diracik dengan standar tertinggi. Kami tidak berkompromi dengan kualitas, mulai dari biji hingga sajian akhir.'],
                        ['leaf', 'Keberlanjutan', 'Kami bermitra dengan petani yang menerapkan praktik pertanian ramah lingkungan untuk menjaga bumi tetap hijau.'],
                        ['users', 'Komunitas', 'Lebih dari sekadar kedai kopi — kami adalah ruang berkumpul, berkreasi, dan berbagi cerita bagi semua orang.'],
                    ] as $val)
                    <div class="group flex flex-col gap-4 rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 p-8 hover:shadow-xl hover:border-primary/30 transition-all">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                            <i data-lucide="{{ $val[0] }}" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold text-coffee-900 dark:text-slate-100">{{ $val[1] }}</h3>
                        <p class="text-coffee-700 dark:text-slate-400 leading-relaxed">{{ $val[2] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-black text-coffee-900 dark:text-slate-100 mb-2">Tim Kami</h2>
                <div class="h-1.5 w-20 bg-primary rounded-full mb-10"></div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach([
                        ['Budi Santoso', 'Pendiri & CEO'],
                        ['Ani Rahayu', 'Head Barista'],
                        ['Riko Pratama', 'Roaster Utama'],
                        ['Sari Dewi', 'Manajer Operasional'],
                    ] as $team)
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary/20 to-coffee-700 flex items-center justify-center border-2 border-primary/20">
                            <i data-lucide="user" class="w-10 h-10 text-primary"></i>
                        </div>
                        <div>
                            <p class="font-bold text-coffee-900 dark:text-slate-100">{{ $team[0] }}</p>
                            <p class="text-sm text-primary font-medium">{{ $team[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
