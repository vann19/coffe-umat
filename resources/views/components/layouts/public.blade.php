<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'Coffe Umat' }}</title>
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
        #mobile-menu { transition: max-height 0.3s ease, opacity 0.3s ease; max-height: 0; opacity: 0; overflow: hidden; }
        #mobile-menu.open { max-height: 400px; opacity: 1; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-coffee-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">

    <!-- Navigation Bar -->
    <header class="border-b border-solid border-coffee-50 dark:border-coffee-900/50 px-4 md:px-20 py-4 sticky top-0 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-md z-50">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-primary">
                <i data-lucide="coffee" class="w-6 h-6 md:w-7 md:h-7"></i>
                <h2 class="text-coffee-900 dark:text-slate-100 text-lg md:text-xl font-black leading-tight tracking-tight">Coffe Umat</h2>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-semibold transition-colors {{ request()->is('menu') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/menu') }}">Menu</a>
                <a class="text-sm font-semibold transition-colors {{ request()->is('lokasi') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="text-sm font-semibold transition-colors {{ request()->is('tentang') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/tentang') }}">Tentang Kami</a>
                <a class="text-sm font-semibold transition-colors {{ request()->is('rewards') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/rewards') }}">Rewards</a>
            </nav>

            <!-- Desktop Right Actions -->
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

            <!-- Mobile Right: Cart + Hamburger -->
            <div class="flex md:hidden items-center gap-2">
                <button class="relative p-2 rounded-lg bg-coffee-50 dark:bg-coffee-900/40 text-coffee-900 dark:text-slate-100">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">2</span>
                </button>
                <button id="hamburger-btn" onclick="toggleMenu()" class="p-2 rounded-lg bg-coffee-50 dark:bg-coffee-900/40 text-coffee-900 dark:text-slate-100 hover:bg-coffee-200 transition-all">
                    <i data-lucide="menu" class="w-5 h-5" id="icon-menu"></i>
                    <i data-lucide="x" class="w-5 h-5 hidden" id="icon-close"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu">
            <div class="pt-4 pb-2 flex flex-col gap-1 border-t border-coffee-100 dark:border-coffee-800 mt-3">
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->is('menu') ? 'bg-primary/10 text-primary' : 'text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 dark:hover:bg-coffee-900/40' }} transition-colors" href="{{ url('/menu') }}">Menu</a>
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->is('lokasi') ? 'bg-primary/10 text-primary' : 'text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 dark:hover:bg-coffee-900/40' }} transition-colors" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->is('tentang') ? 'bg-primary/10 text-primary' : 'text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 dark:hover:bg-coffee-900/40' }} transition-colors" href="{{ url('/tentang') }}">Tentang Kami</a>
                <a class="px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->is('rewards') ? 'bg-primary/10 text-primary' : 'text-coffee-700 dark:text-slate-300 hover:bg-coffee-50 dark:hover:bg-coffee-900/40' }} transition-colors" href="{{ url('/rewards') }}">Rewards</a>
                <!-- Mobile Search -->
                <div class="flex items-center bg-coffee-50 dark:bg-coffee-900/40 rounded-lg px-3 py-2.5 border border-coffee-200 dark:border-coffee-700/50 mt-2">
                    <i data-lucide="search" class="w-4 h-4 text-coffee-700 dark:text-slate-400"></i>
                    <input class="bg-transparent border-none focus:ring-0 text-sm placeholder:text-coffee-700/50 w-full ml-2" placeholder="Cari kopi favoritmu..." type="text"/>
                </div>
                <!-- Mobile Auth -->
                <div class="flex gap-2 mt-2">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex-1 flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-white font-bold text-sm hover:bg-primary/90 transition-colors">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 text-center rounded-lg border border-coffee-200 dark:border-coffee-700 px-4 py-2.5 text-coffee-700 dark:text-slate-300 font-bold text-sm hover:border-primary hover:text-primary transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="flex-1 text-center rounded-lg bg-primary px-4 py-2.5 text-white font-bold text-sm hover:bg-primary/90 transition-colors">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        {{ $slot }}
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
                <a class="h-9 w-9 flex items-center justify-center rounded-full bg-coffee-50 dark:bg-coffee-900/50 text-coffee-700 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                    <i data-lucide="share-2" class="w-4 h-4"></i>
                </a>
                <a class="h-9 w-9 flex items-center justify-center rounded-full bg-coffee-50 dark:bg-coffee-900/50 text-coffee-700 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                <a class="h-9 w-9 flex items-center justify-center rounded-full bg-coffee-50 dark:bg-coffee-900/50 text-coffee-700 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
        <div class="text-center pt-6 border-t border-coffee-50 dark:border-coffee-900/20 text-coffee-700/50 dark:text-slate-500 text-sm">
            © 2024 Coffe Umat Coffee Co. Semua hak dilindungi.
        </div>
    </footer>

</div>
</div>
<script>
    lucide.createIcons();
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');
        menu.classList.toggle('open');
        iconMenu.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    }
</script>
</body>
</html>
