<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Users;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard page
     */
    public function index()
    {
        try {
            // Get top 50 users by points (default to 0 if null)
            $leaderboard = Users::where('role', 'user')
                          ->orderByDesc('total_points')
                          ->limit(50)
                          ->get(['id', 'name', 'username', 'total_points']);

            // Get current user's rank
            $currentUser = Auth::user();
            $userAchievements = null;

            // Ensure current user has total_points value
            if ($currentUser && $currentUser->total_points === null) {
                // Update the total_points directly in the database
                DB::table('users')
                    ->where('id', $currentUser->id)
                    ->update(['total_points' => 0]);

                // Refresh the user model
                $currentUser = Users::find($currentUser->id);
            }

            // Get current user's achievements if logged in
            if ($currentUser) {
                $userAchievements = Achievement::whereHas('users', function($query) use ($currentUser) {
                    $query->where('user_id', $currentUser->id)
                          ->where('unlocked', true);
                })->get();
            }

            // Calculate user rank
            $currentUserRank = 1; // Default to 1st place if no one has more points
            if ($currentUser) {
                $currentUserRank = Users::where('role', 'user')
                              ->where('total_points', '>', ($currentUser->total_points ?? 0))
                              ->count() + 1;
            }

            // Add cache control headers
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Cache-Control: post-check=0, pre-check=0', false);
            header('Pragma: no-cache');
            header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');

            return view('leaderboard.index', compact('leaderboard', 'currentUser', 'currentUserRank', 'userAchievements'));
        } catch (\Exception $e) {
            // Log the error and return a simple view
            Log::error('Leaderboard error: ' . $e->getMessage());

            // Add cache control headers even on error
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Cache-Control: post-check=0, pre-check=0', false);
            header('Pragma: no-cache');
            header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');

            return view('leaderboard.index', [
                'leaderboard' => collect([]),
                'currentUser' => $currentUser ?? null,
                'currentUserRank' => 1,
                'error' => 'Terjadi kesalahan saat memuat leaderboard. Silakan coba lagi nanti.'
            ]);
        }
    }
}
