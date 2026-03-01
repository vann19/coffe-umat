<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Coffe Umat | Pengalaman Kopi Modern</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#cf6317",
                        "background-light": "#f8f7f6",
                        "background-dark": "#211811",
                        "coffee-900": "#1b130e",
                        "coffee-700": "#4a3728",
                        "coffee-200": "#e7d9d0",
                        "coffee-50": "#f3ece7",
                    },
                    fontFamily: { "display": ["Be Vietnam Pro", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        #mobile-menu-home { transition: max-height 0.3s ease, opacity 0.3s ease; max-height: 0; opacity: 0; overflow: hidden; }
        #mobile-menu-home.open { max-height: 400px; opacity: 1; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-coffee-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">

    <!-- Navigation Bar -->
    <header class="border-b border-solid border-coffee-50 dark:border-coffee-900/50 px-4 md:px-20 py-4 sticky top-0 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-md z-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-primary">
                <i data-lucide="coffee" class="w-6 h-6 md:w-7 md:h-7"></i>
                <h2 class="text-coffee-900 dark:text-slate-100 text-lg md:text-xl font-black leading-tight tracking-tight">Coffe Umat</h2>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-semibold hover:text-primary transition-colors text-coffee-700 dark:text-slate-300" href="{{ url('/menu') }}">Menu</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors text-coffee-700 dark:text-slate-300" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors text-coffee-700 dark:text-slate-300" href="{{ url('/tentang') }}">Tentang Kami</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors text-coffee-700 dark:text-slate-300" href="{{ url('/rewards') }}">Rewards</a>
            </nav>
            <div class="hidden md:flex items-center gap-3">
                <div class="flex items-center bg-coffee-50 dark:bg-coffee-900/40 rounded-lg px-3 py-2 border border-coffee-200 dark:border-coffee-700/50">
                    <i data-lucide="search" class="w-4 h-4 text-coffee-700 dark:text-slate-400"></i>
                    <input class="bg-transparent border-none focus:ring-0 text-sm placeholder:text-coffee-700/50 dark:placeholder:text-slate-500 w-36 ml-2" placeholder="Cari kopi..." type="text"/>
                </div>
                <button class="relative p-2 rounded-lg bg-coffee-50 dark:bg-coffee-900/40 text-coffee-900 dark:text-slate-100 hover:bg-coffee-200 transition-all">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">2</span>
                </button>
                @auth
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-white font-bold text-sm hover:bg-primary/90 transition-colors">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-coffee-700 dark:text-slate-300 text-sm font-semibold hover:text-primary transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-primary px-4 py-2 text-white font-bold text-sm hover:bg-primary/90 transition-colors">Daftar</a>
                @endauth
            </div>
            <!-- Mobile: Cart + Hamburger -->
            <div class="flex md:hidden items-center gap-2">
                <button class="relative p-2 rounded-lg bg-coffee-50 dark:bg-coffee-900/40 text-coffee-900 dark:text-slate-100">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">2</span>
                </button>
                <button onclick="toggleHomeMenu()" class="p-2 rounded-lg bg-coffee-50 dark:bg-coffee-900/40 text-coffee-900 dark:text-slate-100">
                    <i data-lucide="menu" class="w-5 h-5" id="hm-menu"></i>
                    <i data-lucide="x" class="w-5 h-5 hidden" id="hm-close"></i>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu-home">
            <div class="pt-4 pb-2 flex flex-col gap-1 border-t border-coffee-100 dark:border-coffee-800 mt-3">
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 transition-colors" href="{{ url('/menu') }}">Menu</a>
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 transition-colors" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 transition-colors" href="{{ url('/tentang') }}">Tentang Kami</a>
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 transition-colors" href="{{ url('/rewards') }}">Rewards</a>
                <div class="flex gap-2 mt-2">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex-1 text-center rounded-lg bg-primary px-4 py-2.5 text-white font-bold text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 text-center rounded-lg border border-coffee-200 px-4 py-2.5 text-coffee-700 font-bold text-sm">Masuk</a>
                        <a href="{{ route('register') }}" class="flex-1 text-center rounded-lg bg-primary px-4 py-2.5 text-white font-bold text-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <!-- Hero Section -->
        <section class="px-3 md:px-20 py-4 md:py-8">
            <div class="relative min-h-[420px] md:min-h-[560px] flex flex-col items-center justify-center overflow-hidden rounded-xl bg-coffee-900 shadow-2xl">
                <div class="absolute inset-0 opacity-60">
                    <img class="h-full w-full object-cover" alt="Latte art kopi dalam cangkir keramik" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCeGYeX6vE9SUBQdToPbWELvC_akQkgPSD9NSo0C1d2tr3DdUu2W4aP6F7ebEfAsp7al-vubCTXcIehlwozAClU2bzAjoEI6h7HRt9dcJ4hfiZtEG1Z9k_ASvgM0VnwaJhhQvmzEmh3V9yU7FUBNWskx42U3f1qBLU56tCYLT3wffsNWAWuCKdkwXTGZUTCp4LtA_Tz5aIgrqI2dLCMjz4ZmZGB_TxJkDTodhwAnc0eo_jK5hc91Fsqi6F5RZSbHv-NRK8QT4fDwe2l"/>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-coffee-900 via-coffee-900/40 to-transparent"></div>
                <div class="relative z-10 flex flex-col gap-6 md:gap-8 text-center px-4 md:px-6 max-w-3xl">
                    <div class="flex flex-col gap-3 md:gap-4">
                        <span class="text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm">Nikmati Seni Kopi</span>
                        <h1 class="text-white text-3xl sm:text-5xl md:text-7xl font-black leading-tight tracking-tight">
                            Secangkir Sempurna, <br/>Setiap Saat.
                        </h1>
                        <p class="text-slate-200 text-sm sm:text-lg md:text-xl font-medium max-w-xl mx-auto leading-relaxed">
                            Disangrai dalam jumlah kecil, biji kopi dari petani terbaik — siap diantar atau diambil di kedai.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto min-w-[160px] rounded-lg bg-primary px-6 md:px-8 py-3 md:py-4 text-white font-bold text-base md:text-lg hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/30 text-center">
                            Pesan Sekarang
                        </a>
                        <a href="{{ url('/menu') }}" class="w-full sm:w-auto min-w-[160px] rounded-lg bg-white/10 backdrop-blur-md border border-white/20 px-6 md:px-8 py-3 md:py-4 text-white font-bold text-base md:text-lg hover:bg-white/20 transition-all text-center">
                            Lihat Menu
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="px-4 md:px-20 py-12 md:py-16">
            <div class="flex flex-col gap-3 mb-8 md:mb-12">
                <h2 class="text-coffee-900 dark:text-slate-100 text-2xl md:text-4xl font-black leading-tight">Standar Kualitas Kami</h2>
                <div class="h-1.5 w-20 bg-primary rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-8">
                <div class="group flex flex-col gap-3 md:gap-4 rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 p-6 md:p-8 hover:shadow-xl hover:border-primary/30 transition-all">
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="sprout" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-coffee-900 dark:text-slate-100">Bahan Berkualitas</h3>
                    <p class="text-coffee-700 dark:text-slate-400 leading-relaxed text-sm md:text-base">Kami bermitra langsung dengan petani terbaik untuk memastikan gaji yang adil dan pertanian berkelanjutan.</p>
                </div>
                <div class="group flex flex-col gap-3 md:gap-4 rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 p-6 md:p-8 hover:shadow-xl hover:border-primary/30 transition-all">
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="flame" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-coffee-900 dark:text-slate-100">Barista Ahli</h3>
                    <p class="text-coffee-700 dark:text-slate-400 leading-relaxed text-sm md:text-base">Disangrai setiap hari dalam jumlah kecil untuk menjaga cita rasa kompleks dan minyak alami setiap biji.</p>
                </div>
                <div class="group flex flex-col gap-3 md:gap-4 rounded-xl border border-coffee-200 dark:border-coffee-700/50 bg-white dark:bg-coffee-900/20 p-6 md:p-8 hover:shadow-xl hover:border-primary/30 transition-all sm:col-span-2 md:col-span-1">
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="zap" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-coffee-900 dark:text-slate-100">Pengiriman Cepat</h3>
                    <p class="text-coffee-700 dark:text-slate-400 leading-relaxed text-sm md:text-base">Kopi diracik dan dikemas dalam hitungan menit setelah pesanan masuk.</p>
                </div>
            </div>
        </section>

        <!-- CTA Newsletter -->
        <section class="px-4 md:px-20 py-14 md:py-20 bg-coffee-50 dark:bg-coffee-900/40">
            <div class="flex flex-col items-center text-center gap-6 md:gap-8 max-w-4xl mx-auto">
                <div class="flex flex-col gap-3 md:gap-4">
                    <h2 class="text-2xl sm:text-3xl md:text-5xl font-black text-coffee-900 dark:text-slate-100">Bergabung dengan Komunitas Kami</h2>
                    <p class="text-sm md:text-lg text-coffee-700 dark:text-slate-400">Dapatkan diskon 20% untuk pesanan pertamamu dan info terbaru seputar rilis kopi musiman kami.</p>
                </div>
                <div class="flex flex-col sm:flex-row w-full max-w-md gap-3">
                    <input class="flex-1 rounded-lg border-coffee-200 dark:border-coffee-700 bg-white dark:bg-coffee-900 px-4 py-3 focus:ring-primary focus:border-primary dark:text-white text-sm" placeholder="Masukkan emailmu" type="email"/>
                    <a href="{{ route('register') }}" class="bg-primary text-white font-bold px-6 md:px-8 py-3 rounded-lg hover:bg-primary/90 transition-colors whitespace-nowrap text-center text-sm md:text-base">Daftar Gratis</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-coffee-50 dark:border-coffee-900/50 px-4 md:px-20 py-10 md:py-12 bg-background-light dark:bg-background-dark">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 md:gap-8 mb-6 md:mb-8">
            <div class="flex items-center gap-3 text-primary">
                <i data-lucide="coffee" class="w-7 h-7"></i>
                <span class="text-xl font-black text-coffee-900 dark:text-slate-100">Coffe Umat</span>
            </div>
            <div class="flex flex-wrap justify-center gap-4 md:gap-8 text-sm">
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Hubungi Kami</a>
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Keberlanjutan</a>
            </div>
            <div class="flex gap-3">
                <a class="h-9 w-9 flex items-center justify-center rounded-full bg-coffee-50 dark:bg-coffee-900/50 text-coffee-700 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#"><i data-lucide="share-2" class="w-4 h-4"></i></a>
                <a class="h-9 w-9 flex items-center justify-center rounded-full bg-coffee-50 dark:bg-coffee-900/50 text-coffee-700 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                <a class="h-9 w-9 flex items-center justify-center rounded-full bg-coffee-50 dark:bg-coffee-900/50 text-coffee-700 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#"><i data-lucide="message-circle" class="w-4 h-4"></i></a>
            </div>
        </div>
        <div class="text-center pt-6 border-t border-coffee-50 dark:border-coffee-900/20 text-coffee-700/50 dark:text-slate-500 text-sm">
            © 2024 Coffe Umat Coffee Co. Semua hak dilindungi. Meracik momen, satu cangkir demi satu cangkir.
        </div>
    </footer>

</div>
</div>
<script>
    lucide.createIcons();
    function toggleHomeMenu() {
        const menu = document.getElementById('mobile-menu-home');
        const m = document.getElementById('hm-menu');
        const c = document.getElementById('hm-close');
        menu.classList.toggle('open');
        m.classList.toggle('hidden');
        c.classList.toggle('hidden');
    }
</script>
</body>
</html>
