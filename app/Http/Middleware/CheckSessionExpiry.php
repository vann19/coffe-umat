<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionExpiry
{
    /**
     * Durasi sesi maksimum: 24 jam (dalam detik)
     */
    const SESSION_DURATION = 86400; // 24 * 60 * 60

    /**
     * Handle an incoming request.
     * Logout otomatis jika user sudah login lebih dari 24 jam.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $loginTime = session('login_time');

            if ($loginTime === null) {
                // Pertama kali login, simpan waktu login
                session(['login_time' => now()->timestamp]);
            } elseif ((now()->timestamp - $loginTime) > self::SESSION_DURATION) {
                // Sudah lebih dari 24 jam → logout paksa
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with(
                    'status',
                    'Sesi kamu telah berakhir setelah 24 jam. Silakan masuk kembali.'
                );
            }
        }

        return $next($request);
    }
}
