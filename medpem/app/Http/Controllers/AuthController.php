<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $newDeviceToken = Str::random(60);

            // Update device token and invalidate old sessions
            $user->update([
                'device_token' => $newDeviceToken,
                'last_activity' => now()
            ]);

            return redirect()->intended('dashboard')->cookie('device_token', $newDeviceToken, 60 * 24 * 30); // 30 days
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->update([
                'device_token' => null,
                'last_activity' => null
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->cookie('device_token', '', -1);
    }

    /**
     * Check if device is authorized
     */
    public function checkDevice(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentDeviceToken = $request->cookie('device_token');

            // If user has no device token, they're allowed to continue
            if (!$user->device_token) {
                return response()->json([
                    'authorized' => true
                ]);
            }

            // If device token matches, they're authorized
            if ($currentDeviceToken === $user->device_token) {
                return response()->json([
                    'authorized' => true
                ]);
            }

            // If device token doesn't match, they need to login again
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'authorized' => false,
                'message' => 'Akun ini sedang digunakan di perangkat lain.'
            ]);
        }

        return response()->json([
            'authorized' => false,
            'message' => 'Tidak terautentikasi'
        ]);
    }
}
