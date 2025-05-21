<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin or superadmin role
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            return $next($request);
        }

        // If the user is a regular user, redirect to the user materi route
        if (Auth::check() && Auth::user()->role === 'user') {
            if ($request->is('materi') || $request->is('materi/*')) {
                return redirect()->route('user.materi.index')
                    ->with('error', 'Akses ditolak. Anda telah diarahkan ke halaman materi untuk pengguna.');
            }
        }

        // Otherwise redirect to login page
        return redirect()->route('login')
            ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
