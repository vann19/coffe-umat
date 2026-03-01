<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Panel | Coffe Umat</title>
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
                        "coffee-50":  "#f3ece7",
                    },
                    fontFamily: { "display": ["Be Vietnam Pro", "sans-serif"] },
                },
            },
        }
    </script>
    <style>
        body { font-family: "Be Vietnam Pro", sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-coffee-50 text-slate-900 min-h-screen">

<div class="flex min-h-screen">

    <!-- ── SIDEBAR ───────────────────────────────────────────── -->
    <aside class="hidden lg:flex flex-col w-64 bg-coffee-900 text-white shrink-0">
        <!-- Logo -->
        <div class="flex items-center gap-2.5 px-6 py-5 border-b border-white/10">
            <i data-lucide="coffee" class="w-6 h-6 text-primary"></i>
            <div>
                <h1 class="font-black text-base leading-tight">Coffe Umat</h1>
                <p class="text-xs text-slate-400">Admin Panel</p>
            </div>
        </div>
        <!-- Nav -->
        <nav class="flex-1 p-4 space-y-1">
            <p class="text-[10px] uppercase tracking-widest text-slate-500 px-3 mb-2 mt-3">Utama</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/20 text-primary font-semibold text-sm">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:bg-white/5 hover:text-white transition-colors text-sm">
                <i data-lucide="users" class="w-4 h-4"></i> Kelola User
            </a>
            <a href="{{ route('admin.menu') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:bg-white/5 hover:text-white transition-colors text-sm">
                <i data-lucide="package" class="w-4 h-4"></i> Kelola Menu
            </a>
            <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:bg-white/5 hover:text-white transition-colors text-sm">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Pesanan
            </a>
            <p class="text-[10px] uppercase tracking-widest text-slate-500 px-3 mb-2 mt-5">Laporan</p>
            <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:bg-white/5 hover:text-white transition-colors text-sm">
                <i data-lucide="bar-chart-2" class="w-4 h-4"></i> Penjualan
            </a>
            <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:bg-white/5 hover:text-white transition-colors text-sm">
                <i data-lucide="star" class="w-4 h-4"></i> Program Rewards
            </a>
        </nav>
        <!-- User info + logout -->
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

    <!-- ── MAIN AREA ─────────────────────────────────────────── -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Bar -->
        <header class="flex items-center justify-between px-5 py-4 bg-white border-b border-coffee-200 sticky top-0 z-40">
            <div>
                <h2 class="font-black text-lg text-coffee-900">Dashboard Admin</h2>
                <p class="text-xs text-slate-400">Selamat datang, {{ Auth::user()->name }} 👋</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full">🛡️ Admin</span>
                <!-- Mobile Logout -->
                <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-5 lg:p-8 space-y-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([
                    ['Total User', $stats['total_users'],   'users',        'text-blue-600',   'bg-blue-50',   '+12% dari bulan lalu'],
                    ['Pesanan Hari Ini', $stats['orders_today'], 'shopping-bag', 'text-primary',    'bg-primary/10', '+5 pesanan baru'],
                    ['Pendapatan Hari Ini', 'Rp ' . number_format($stats['revenue_today'], 0, ',', '.'), 'banknote', 'text-green-600', 'bg-green-50', 'Hari ini'],
                    ['Menu Tersedia', $stats['total_menu'],  'coffee',       'text-amber-600',  'bg-amber-50',  'Item aktif'],
                ] as $stat)
                <div class="bg-white rounded-xl p-5 border border-coffee-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs font-semibold text-slate-500">{{ $stat[0] }}</p>
                        <div class="w-8 h-8 {{ $stat[4] }} rounded-lg flex items-center justify-center">
                            <i data-lucide="{{ $stat[2] }}" class="w-4 h-4 {{ $stat[3] }}"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-black text-coffee-900">{{ $stat[1] }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $stat[5] }}</p>
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Daftar User Terbaru -->
                <div class="lg:col-span-2 bg-white rounded-xl border border-coffee-200 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-coffee-100">
                        <h3 class="font-black text-sm text-coffee-900">User Terdaftar</h3>
                        <span class="text-xs text-slate-400">{{ $stats['total_users'] }} total</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-coffee-50 text-left">
                                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Bergabung</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-coffee-100">
                                @forelse($recentUsers as $user)
                                <tr class="hover:bg-coffee-50 transition-colors">
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-primary/10 text-primary flex items-center justify-center font-black text-xs">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold text-coffee-900">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 text-slate-500">{{ $user->email }}</td>
                                    <td class="px-5 py-3">
                                        @if($user->role === 'admin')
                                        <span class="bg-primary/10 text-primary text-xs font-bold px-2 py-0.5 rounded-full">Admin</span>
                                        @else
                                        <span class="bg-slate-100 text-slate-500 text-xs font-medium px-2 py-0.5 rounded-full">User</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3 text-slate-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Belum ada user</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-4">
                    <div class="bg-white rounded-xl border border-coffee-200 p-5">
                        <h3 class="font-black text-sm text-coffee-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-2.5">
                            <a href="{{ route('admin.menu.create') }}" class="w-full flex items-center gap-3 p-3 rounded-lg bg-primary/10 text-primary hover:bg-primary/20 transition-colors text-sm font-semibold">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                Tambah Menu Baru
                            </a>
                            <a href="{{ route('admin.orders') }}" class="w-full flex items-center gap-3 p-3 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors text-sm font-semibold">
                                <i data-lucide="list" class="w-4 h-4"></i>
                                Lihat Semua Pesanan
                            </a>
                            <a href="{{ route('admin.reports') }}" class="w-full flex items-center gap-3 p-3 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition-colors text-sm font-semibold">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                Export Laporan
                            </a>
                            <a href="{{ route('admin.settings') }}" class="w-full flex items-center gap-3 p-3 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors text-sm font-semibold">
                                <i data-lucide="settings" class="w-4 h-4"></i>
                                Pengaturan Sistem
                            </a>
                        </div>
                    </div>

                    <!-- Info Session -->
                    <div class="bg-coffee-900 rounded-xl p-5 text-white">
                        <div class="flex items-center gap-2 mb-3">
                            <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i>
                            <p class="text-sm font-bold">Sesi Login</p>
                        </div>
                        @php
                            $loginTime = session('login_time');
                            $elapsed   = $loginTime ? now()->timestamp - $loginTime : 0;
                            $remaining = max(0, 86400 - $elapsed);
                            $hours     = floor($remaining / 3600);
                            $minutes   = floor(($remaining % 3600) / 60);
                        @endphp
                        <p class="text-2xl font-black text-primary">{{ $hours }}j {{ $minutes }}m</p>
                        <p class="text-xs text-slate-400 mt-1">sisa waktu sesi (auto-logout 24 jam)</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>
