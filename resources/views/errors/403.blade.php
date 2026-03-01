<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>403 - Akses Ditolak | Coffe Umat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style> body { font-family: 'Be Vietnam Pro', sans-serif; } </style>
</head>
<body class="min-h-screen bg-[#f3ece7] flex items-center justify-center px-4">
    <div class="text-center max-w-md">
        <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6">
            <i data-lucide="shield-off" class="w-10 h-10 text-red-500"></i>
        </div>
        <h1 class="text-6xl font-black text-[#1b130e] mb-2">403</h1>
        <h2 class="text-xl font-bold text-slate-700 mb-3">Akses Ditolak</h2>
        <p class="text-slate-500 text-sm mb-8">Halaman ini hanya dapat diakses oleh <strong>Administrator</strong>. Kamu tidak memiliki izin untuk masuk ke sini.</p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 bg-[#cf6317] text-white font-bold px-5 py-2.5 rounded-lg hover:opacity-90 transition text-sm">
                <i data-lucide="home" class="w-4 h-4"></i> Ke Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 border border-slate-300 text-slate-600 font-bold px-5 py-2.5 rounded-lg hover:bg-slate-50 transition text-sm">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                </button>
            </form>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
