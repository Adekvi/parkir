<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sedang login
        if (Auth::check()) {
            // Periksa status pengguna
            if (Auth::user()->status == 1) {
                Auth::logout(); // Logout user
                return redirect()->route('login.index')->with('error', 'Akun Anda dinonaktifkan. Hubungi Admin!');
            }
        }

        return $next($request);
    }
}
