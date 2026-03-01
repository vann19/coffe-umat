<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk | Coffe Umat</title>
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
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <!-- Header / Nav -->
    <header class="flex items-center justify-between border-b border-primary/20 px-5 py-4 lg:px-20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md sticky top-0 z-50">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5">
            <div class="bg-primary p-2 rounded-lg text-white">
                <i data-lucide="coffee" class="w-5 h-5 block"></i>
            </div>
            <h1 class="text-lg font-black tracking-tight text-slate-900 dark:text-slate-100">Coffe Umat</h1>
        </a>
        <div class="flex items-center gap-3">
            <button class="relative p-2 rounded-full hover:bg-primary/10 transition-colors">
                <i data-lucide="shopping-cart" class="w-5 h-5 text-slate-700 dark:text-slate-300"></i>
                <span class="absolute top-1 right-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-primary text-[9px] font-bold text-white">2</span>
            </button>
            <a href="{{ route('register') }}" class="bg-primary text-white text-sm font-bold h-9 px-5 rounded-lg hover:brightness-110 transition-all flex items-center justify-center">
                Daftar
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-4 md:p-6 relative">

        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-background-dark/60 to-background-dark/90 z-10"></div>
            <img class="w-full h-full object-cover" alt="Interior kedai kopi modern yang hangat" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoXjpAWAWxC4PXAc_9jGKhh-Y4XTDZrrv72DTz2g-GoLEzydP_Hbz3_jIdKh4yGbT3hRuLoOAgyrirfu37xrcbO9gZ7n6M1zyBZ9GqZeTcDncjr9Lz74eNhWuzhMOdb15BDSXWG4ePerh7-0OeKWsfkxhty4JBEDS9wamk6FfN2gpIimfjV8VD-8XHMmSB3I7dH5ho8me40tm6B0PlYswCosPDQqgaBPf6DYqtyfU2iATEI-gPeb5IA-dQft_5KTDI8KZ1hDF8Fp_e"/>
        </div>

        <!-- Login Card -->
        <div class="relative z-20 w-full max-w-md bg-background-light dark:bg-background-dark/95 border border-primary/10 shadow-2xl rounded-xl p-7 md:p-8 backdrop-blur-sm">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col items-center mb-7">
                <div class="bg-primary/10 p-4 rounded-full mb-4 text-primary">
                    <i data-lucide="coffee" class="w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-slate-100">Selamat Datang</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">Aroma kopi segar menunggumu ☕</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 bg-slate-100 dark:bg-primary/5 border @error('email') border-red-500 @else border-slate-200 dark:border-primary/20 @enderror rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-slate-900 dark:text-slate-100 text-sm placeholder:text-slate-400 dark:placeholder:text-slate-600"
                            placeholder="nama@example.com"/>
                    </div>
                    @error('email')
                        <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-primary hover:underline font-medium" href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="password" name="password" type="password" required
                            class="w-full pl-10 pr-12 py-3 bg-slate-100 dark:bg-primary/5 border @error('password') border-red-500 @else border-slate-200 dark:border-primary/20 @enderror rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-slate-900 dark:text-slate-100 text-sm placeholder:text-slate-400 dark:placeholder:text-slate-600"
                            placeholder="••••••••"/>
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                            <i data-lucide="eye" class="w-4 h-4" id="eye-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                        class="w-4 h-4 rounded border-slate-300 dark:border-primary/30 text-primary focus:ring-primary bg-slate-100 dark:bg-primary/5"/>
                    <label for="remember_me" class="ml-2 text-sm text-slate-600 dark:text-slate-400">Ingat saya selama 30 hari</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full py-3.5 bg-primary hover:brightness-110 text-white font-bold rounded-lg shadow-lg shadow-primary/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2 text-sm md:text-base">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Masuk ke Akun
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200 dark:border-primary/10"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-background-light dark:bg-background-dark px-2 text-slate-400">atau lanjutkan dengan</span>
                </div>
            </div>

            <!-- Social Buttons -->
            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center gap-2 py-2.5 border border-slate-200 dark:border-primary/20 rounded-lg hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors text-sm font-medium">
                    <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                    Google
                </button>
                <button class="flex items-center justify-center gap-2 py-2.5 border border-slate-200 dark:border-primary/20 rounded-lg hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors text-sm font-medium">
                    <i data-lucide="smartphone" class="w-4 h-4 text-slate-600 dark:text-slate-400"></i>
                    Telepon
                </button>
            </div>

            <!-- Sign Up CTA -->
            <p class="mt-7 text-center text-sm text-slate-500 dark:text-slate-400">
                Belum punya akun?
                <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register') }}">Daftar gratis</a>
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="p-4 md:p-6 text-center text-slate-500 dark:text-slate-400 text-xs z-20 relative">
        <p>© 2024 Coffe Umat Coffee Co. Semua hak dilindungi.</p>
        <div class="flex justify-center gap-4 mt-2">
            <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
            <a class="hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
            <a class="hover:text-primary transition-colors" href="#">Kontak</a>
        </div>
    </footer>

<script>
    lucide.createIcons();
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
</body>
</html>
