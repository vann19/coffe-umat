<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'Coffe Umat' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-coffee-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">

    <!-- Navigation Bar -->
    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-coffee-50 dark:border-coffee-900/50 px-6 md:px-20 py-4 sticky top-0 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md z-50">
        <div class="flex items-center gap-12">
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-primary">
                <span class="material-symbols-outlined text-3xl">coffee</span>
                <h2 class="text-coffee-900 dark:text-slate-100 text-xl font-black leading-tight tracking-tight">Coffe Umat</h2>
            </a>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-semibold transition-colors {{ request()->is('menu') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/menu') }}">Menu</a>
                <a class="text-sm font-semibold transition-colors {{ request()->is('lokasi') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="text-sm font-semibold transition-colors {{ request()->is('tentang') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/tentang') }}">Tentang Kami</a>
                <a class="text-sm font-semibold transition-colors {{ request()->is('rewards') ? 'text-primary' : 'text-coffee-700 dark:text-slate-300 hover:text-primary' }}" href="{{ url('/rewards') }}">Rewards</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden lg:flex items-center bg-coffee-50 dark:bg-coffee-900/40 rounded-lg px-3 py-2 border border-coffee-200 dark:border-coffee-700/50">
                <span class="material-symbols-outlined text-coffee-700 dark:text-slate-400 text-xl">search</span>
                <input class="bg-transparent border-none focus:ring-0 text-sm placeholder:text-coffee-700/50 dark:placeholder:text-slate-500 w-40" placeholder="Cari kopi favoritmu..." type="text"/>
            </div>
            <button class="relative p-2 rounded-lg bg-coffee-50 dark:bg-coffee-900/40 text-coffee-900 dark:text-slate-100 hover:bg-coffee-200 dark:hover:bg-coffee-700 transition-all">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">2</span>
            </button>
            @auth
                <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-white font-bold text-sm hover:bg-primary/90 transition-colors">
                    <span class="material-symbols-outlined text-base">dashboard</span>
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-coffee-700 dark:text-slate-300 text-sm font-semibold hover:text-primary transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-primary px-4 py-2 text-white font-bold text-sm hover:bg-primary/90 transition-colors">Daftar</a>
            @endauth
        </div>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="border-t border-coffee-50 dark:border-coffee-900/50 px-6 md:px-20 py-12 bg-background-light dark:bg-background-dark">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-8">
            <div class="flex items-center gap-3 text-primary">
                <span class="material-symbols-outlined text-3xl">coffee</span>
                <span class="text-xl font-black text-coffee-900 dark:text-slate-100">Coffe Umat</span>
            </div>
            <div class="flex flex-wrap justify-center gap-8">
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Hubungi Kami</a>
                <a class="text-coffee-700 dark:text-slate-400 hover:text-primary transition-colors" href="#">Keberlanjutan</a>
            </div>
        </div>
        <div class="text-center pt-8 border-t border-coffee-50 dark:border-coffee-900/20 text-coffee-700/50 dark:text-slate-500 text-sm">
            © 2024 Coffe Umat Coffee Co. Semua hak dilindungi.
        </div>
    </footer>

</div>
</div>
</body>
</html>
