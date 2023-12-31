<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class BiroKemahasiswaanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah biro kemahasiswaan sudah login
        if (Auth::guard('biro_kemahasiswaan')->check()) {
            return $next($request);
        }
    
        return redirect('/biro/login');
    }
}
