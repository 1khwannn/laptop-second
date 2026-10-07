<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah user sudah login dan memiliki kolom role bernilai 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda bukan admin.');
    }
}