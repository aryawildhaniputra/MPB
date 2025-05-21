<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has superadmin role
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return $next($request);
        }

        // If the user is an admin, redirect with an error message
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Akses ditolak. Hanya Super Admin yang dapat mengakses halaman tersebut.');
        }

        // Otherwise redirect to login page
        return redirect()->route('login')
            ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
