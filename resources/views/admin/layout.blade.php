@php
/* ── shared sidebar partial ── */
$navLinks = [
    ['admin.dashboard',  'layout-dashboard', 'Dashboard'],
    ['admin.users',      'users',             'Kelola User'],
    ['admin.menu',       'package',           'Kelola Menu'],
    ['admin.orders',     'shopping-bag',      'Pesanan'],
    ['admin.reports',    'bar-chart-2',       'Laporan Penjualan'],
    ['admin.settings',   'settings',          'Pengaturan Sistem'],
];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $pageTitle ?? 'Admin' }} | Coffe Umat</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    "primary":"#cf6317","coffee-900":"#1b130e","coffee-700":"#4a3728",
                    "coffee-200":"#e7d9d0","coffee-50":"#f3ece7"
                },
                fontFamily: { "display": ["Be Vietnam Pro","sans-serif"] }
            }}
        }
    </script>
    <style>body{font-family:"Be Vietnam Pro",sans-serif;}</style>
</head>
<body class="bg-coffee-50 text-slate-900 min-h-screen">
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="hidden lg:flex flex-col w-64 bg-coffee-900 text-white shrink-0">
        <div class="flex items-center gap-2.5 px-6 py-5 border-b border-white/10">
            <i data-lucide="coffee" class="w-6 h-6 text-primary"></i>
            <div>
                <h1 class="font-black text-base leading-tight">Coffe Umat</h1>
                <p class="text-xs text-slate-400">Admin Panel</p>
            </div>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            @foreach($navLinks as [$routeName, $icon, $label])
            <a href="{{ route($routeName) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                      {{ request()->routeIs($routeName) ? 'bg-primary/20 text-primary font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="{{ $icon }}" class="w-4 h-4"></i> {{ $label }}
            </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-black text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-primary font-bold">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors text-sm">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="flex items-center justify-between px-5 py-4 bg-white border-b border-coffee-200 sticky top-0 z-40">
            <div>
                <h2 class="font-black text-lg text-coffee-900">{{ $pageTitle ?? 'Admin' }}</h2>
                <p class="text-xs text-slate-400">{{ $pageSubtitle ?? '' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full hidden sm:block">🛡️ Admin</span>
                <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </header>
        <main class="flex-1 p-5 lg:p-8">
            @yield('content')
        </main>
    </div>
</div>
<script>lucide.createIcons();</script>
</body>
</html>
