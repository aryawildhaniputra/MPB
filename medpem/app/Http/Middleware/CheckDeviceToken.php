<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDeviceToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentDeviceToken = $request->cookie('device_token');

            // If user has no device token or if device token matches, allow access
            if (!$user->device_token || $currentDeviceToken === $user->device_token) {
                return $next($request);
            }

            // If device token doesn't match, log them out
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // If it's an API request, return JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'authorized' => false,
                    'message' => 'Akun ini sedang digunakan di perangkat lain.'
                ]);
            }

            // For web requests, redirect to login with message
            return redirect()->route('login')
                ->with('error', 'Akun ini sedang digunakan di perangkat lain.');
        }

        return $next($request);
    }
}
