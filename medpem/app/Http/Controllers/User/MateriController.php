<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MateriController extends Controller
{
    /**
     * Display a listing of the materials for regular users.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $materis = Materi::when($search, function($query) use ($search) {
            // Clean up and normalize search term
            $search = trim($search);

            // Split search by spaces or slashes to handle partial terms
            $searchTerms = preg_split('/[\s\/]+/', $search, -1, PREG_SPLIT_NO_EMPTY);

            return $query->where(function($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if (strlen($term) >= 2) { // Only search for terms with at least 2 characters
                        // Use the LOWER function for case-insensitive comparison
                        $q->orWhereRaw('LOWER(title) LIKE ?', ['%' . strtolower($term) . '%']);
                    }
                }
            });
        })->get();

        return view('user.materi.index', compact('materis', 'search'));
    }

    /**
     * Display the specified material.
     */
    public function show(Materi $materi)
    {
        $userProgress = 0;
        $documents = $materi->documents;

        // Only track access if user is authenticated
        if (Auth::check()) {
            // Get the authenticated user from Users model
            $user = Users::find(Auth::id());
            if ($user) {
                // Get user's current progress for this materi
                $userMateri = $user->materi()->where('materi_id', $materi->id)->first();

                // Only track access if this is a new view (no existing record)
                // or if the user hasn't completed this materi yet
                if (!$userMateri || !$userMateri->pivot->completed) {
                    // Just track access without changing progress
                    // Use a special method that only updates last_accessed_at without modifying progress
                    $user->trackMateriVisit($materi->id);
                }

                // Get current progress
                $userProgress = $materi->getProgressForUser($user->id);
            }
        }

        return view('user.materi.show', compact('materi', 'userProgress', 'documents'));
    }

    /**
     * Update the progress for a materi.
     */
    public function updateProgress(Request $request, Materi $materi)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);

        // Get the authenticated user from Users model
        $user = Users::find(Auth::id());
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the materi is already completed
        $userMateri = $materi->users()
            ->where('user_id', $user->id)
            ->first();

        // If materi is already completed, just return success
        if ($userMateri && $userMateri->pivot->completed) {
            return response()->json([
                'progress' => $userMateri->pivot->progress,
                'completed' => true,
                'last_accessed_at' => $userMateri->pivot->last_accessed_at,
                'points_awarded' => 0,
                'message' => 'Materi already completed'
            ]);
        }

        $completed = $request->progress >= 100;
        $progress = $user->trackMateriProgress($materi->id, $request->progress, $completed);

        // Points awarding is disabled
        $pointsAwarded = 0;

        $newAchievements = [];
        if ($completed && $progress->completed) {
            // Log that points are not awarded (disabled)
            Log::info("Points NOT awarded for materi completion (disabled): user {$user->id} for materi {$materi->id}");

            // Set points_awarded to 0 to indicate it's been processed
            $materi->users()->updateExistingPivot($user->id, ['points_awarded' => 0]);

            // Check for achievements after completing a materi
            $newAchievements = $this->checkAchievements($user);
        }

        return response()->json([
            'progress' => $progress->progress,
            'completed' => $progress->completed,
            'last_accessed_at' => $progress->last_accessed_at,
            'points_awarded' => 0,
            'has_achievements' => !empty($newAchievements),
            'achievements' => $newAchievements
        ]);
    }

    /**
     * Check and update user's achievements.
     *
     * @param Users $user
     * @return array The newly unlocked achievements
     */
    private function checkAchievements($user)
    {
        // Get app's DashboardController instance to use its achievement check method
        $dashboardController = app()->make('App\Http\Controllers\DashboardController');

        // Call the checkAndUpdateAchievements method and return the unlocked achievements
        return $dashboardController->checkAndUpdateAchievements($user);
    }
}
