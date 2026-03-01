<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar | Coffe Umat</title>
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
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased font-display">
<div class="relative min-h-screen flex flex-col">

    <!-- Navigation -->
    <header class="flex items-center justify-between px-5 lg:px-40 py-4 border-b border-slate-200 dark:border-primary/20 bg-background-light dark:bg-background-dark/95 sticky top-0 z-50">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-primary">
            <i data-lucide="coffee" class="w-7 h-7"></i>
            <h2 class="text-base md:text-lg font-black tracking-tight text-coffee-900 dark:text-slate-100">Coffe Umat</h2>
        </a>
        <div class="flex items-center gap-4 md:gap-8">
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ url('/menu') }}">Menu</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ url('/tentang') }}">Tentang</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ url('/rewards') }}">Rewards</a>
            </nav>
            <a href="{{ route('login') }}" class="bg-primary text-white text-sm font-bold h-9 px-5 rounded-lg hover:brightness-110 transition-all flex items-center justify-center">
                Masuk
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-4 md:p-10 relative overflow-hidden">

        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-cover bg-center opacity-40 dark:opacity-20" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMxVaRBIK0Fhk6I0aAuZNKz6LLDSTToGLhDuCzyyXR_mtbmKpxhzXCjxvbjVWCsNcvLaL-Yzj9WsIASKdKtVDAck1F9eAuXQ0A5w0VzuuEtlJTumU78iMkQd6r9D-phaLXwI2FaP4a97KUls2Ny_jRj30y7JLas5x_IbAE-hAoEQAmP9W9sFFGHfV293mcPSiJ4OSYQFPMSS8vnpTAs2H0Mpig1cdi1hGcTdzbM-WwJ6KL6FSzTafMAVtRM-kxpN1JPH42D4dFWVhx');"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-background-light/80 via-background-light/40 to-background-light dark:from-background-dark/80 dark:via-background-dark/40 dark:to-background-dark"></div>
        </div>

        <!-- Registration Card -->
        <div class="w-full max-w-[480px] bg-white dark:bg-background-dark/70 backdrop-blur-md border border-slate-200 dark:border-primary/20 rounded-xl shadow-2xl p-6 md:p-10 relative z-10">

            <div class="text-center mb-7">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary mb-4">
                    <i data-lucide="coffee" class="w-6 h-6"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-black mb-1">Buat Akun</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Bergabunglah dan dapatkan rewards eksklusif</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold mb-1.5 ml-1">Nama Lengkap</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-primary/5 border @error('name') border-red-500 @else border-slate-200 dark:border-primary/20 @enderror rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 text-sm"
                            placeholder="Budi Santoso"/>
                    </div>
                    @error('name')
                        <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold mb-1.5 ml-1">Alamat Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-primary/5 border @error('email') border-red-500 @else border-slate-200 dark:border-primary/20 @enderror rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 text-sm"
                            placeholder="budi@example.com"/>
                    </div>
                    @error('email')
                        <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone (Opsional) -->
                <div>
                    <label for="phone" class="block text-sm font-semibold mb-1.5 ml-1">
                        No. Telepon <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="phone" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-primary/5 border border-slate-200 dark:border-primary/20 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 text-sm"
                            placeholder="08123456789"/>
                    </div>
                </div>

                <!-- Password & Confirm -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-1.5 ml-1">Password</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="password" name="password" type="password" required
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-primary/5 border @error('password') border-red-500 @else border-slate-200 dark:border-primary/20 @enderror rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 text-sm"
                                placeholder="••••••••"/>
                        </div>
                        @error('password')
                            <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold mb-1.5 ml-1">Konfirmasi</label>
                        <div class="relative">
                            <i data-lucide="shield-check" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-primary/5 border border-slate-200 dark:border-primary/20 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 text-sm"
                                placeholder="••••••••"/>
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3 py-1">
                    <div class="flex items-center h-5 mt-0.5">
                        <input id="terms" type="checkbox" required class="w-4 h-4 rounded border-slate-300 dark:border-primary/30 text-primary focus:ring-primary bg-transparent"/>
                    </div>
                    <label class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed cursor-pointer" for="terms">
                        Saya setuju dengan <a class="text-primary hover:underline font-medium" href="#">Syarat & Ketentuan</a> dan <a class="text-primary hover:underline font-medium" href="#">Kebijakan Privasi</a>, termasuk menerima komunikasi pemasaran.
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-primary hover:brightness-110 active:scale-[0.98] text-white font-bold py-3.5 rounded-lg transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 text-sm md:text-base">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-7 pt-6 border-t border-slate-200 dark:border-primary/10 text-center">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Sudah punya akun?
                    <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">Masuk di sini</a>
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="px-5 lg:px-40 py-6 border-t border-slate-200 dark:border-primary/10 bg-background-light dark:bg-background-dark text-slate-400 text-xs text-center">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <p>© 2024 Coffe Umat Coffee Co. Semua hak dilindungi.</p>
            <div class="flex gap-5">
                <a class="hover:text-primary transition-colors" href="#">Privasi</a>
                <a class="hover:text-primary transition-colors" href="#">Syarat</a>
                <a class="hover:text-primary transition-colors" href="#">Kontak</a>
            </div>
        </div>
    </footer>

</div>
<script>lucide.createIcons();</script>
</body>
</html>
