<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Users;
use App\Services\AchievementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AchievementController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    /**
     * Display a list of all achievements with their unlock status for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Users::find(Auth::id());

        // Get all achievements
        $achievements = Achievement::where('active', true)->get();

        // Mark achievements as unlocked if the user has them
        $unlockedAchievementIds = $user->achievements()
            ->wherePivot('unlocked', true)
            ->pluck('achievement_id')
            ->toArray();

        foreach ($achievements as $achievement) {
            $achievement->is_unlocked = in_array($achievement->id, $unlockedAchievementIds);
            if ($achievement->is_unlocked) {
                // Get the timestamp when it was unlocked
                $userAchievement = $user->achievements()->where('achievement_id', $achievement->id)->first();
                $achievement->unlocked_at = $userAchievement->pivot->unlocked_at;
            }
        }

        // Count totals for display
        $totalCount = $achievements->count();
        $unlockedCount = count($unlockedAchievementIds);

        return view('achievements.index', compact('achievements', 'totalCount', 'unlockedCount'));
    }

    /**
     * Check all achievements for the current user and return newly unlocked ones.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkAchievements()
    {
        $user = Users::find(Auth::id());

        // Get the service
        $achievementService = app(AchievementService::class);

        // Check for achievements
        $newlyUnlocked = $achievementService->checkAchievements($user);

        // Pass newly unlocked achievements to the session for notification
        if (count($newlyUnlocked) > 0) {
            session()->flash('achievement_unlocked', $newlyUnlocked);
        }

        return redirect()->route('achievements.index')
                        ->with('success', 'Pencapaian berhasil diperiksa!');
    }

    /**
     * Get detailed information about a specific achievement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Users::find(Auth::id());
        $achievement = Achievement::findOrFail($id);

        // Check if the user has unlocked this achievement
        $userAchievement = $user->achievements()->where('achievement_id', $id)->first();
        $achievement->is_unlocked = $userAchievement && $userAchievement->pivot->unlocked;

        if ($achievement->is_unlocked) {
            $achievement->unlocked_at = $userAchievement->pivot->unlocked_at;
        }

        return view('achievements.show', compact('achievement'));
    }

    /**
     * Test method to check speed achievements.
     * This creates a test lesson record with fast completion time.
     */
    public function testSpeedAchievement()
    {
        $user = Users::find(Auth::id());

        // Get the first lesson or create one if none exists
        $lesson = \App\Models\Lesson::first();

        if (!$lesson) {
            \Illuminate\Support\Facades\Log::error("No lessons found for speed achievement test");
            return redirect()->route('achievements.index')
                            ->with('error', 'No lessons found for testing');
        }

        \Illuminate\Support\Facades\Log::info("Testing speed achievement with lesson {$lesson->id} for user {$user->id}");

        // Create a test record with part completion
        $startedAt = Carbon::now()->subMinutes(1); // Started 1 minute ago

        // Check if the user already has this lesson
        $existingRecord = DB::table('user_lessons')
            ->where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->first();

        if ($existingRecord) {
            // Update the existing record
            DB::table('user_lessons')
                ->where('user_id', $user->id)
                ->where('lesson_id', $lesson->id)
                ->update([
                    'started_at' => $startedAt,
                    'part1_completed' => true,
                    'part1_completed_at' => Carbon::now()->subSeconds(40), // Completed 40 seconds after starting
                    'updated_at' => Carbon::now()
                ]);

            \Illuminate\Support\Facades\Log::info("Updated existing user_lesson record with fast completion time");
        } else {
            // Insert a new record
            DB::table('user_lessons')->insert([
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
                'started_at' => $startedAt,
                'part1_completed' => true,
                'part1_completed_at' => Carbon::now()->subSeconds(40), // Completed 40 seconds after starting
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            \Illuminate\Support\Facades\Log::info("Created new user_lesson record with fast completion time");
        }

        // Now check for speed achievements
        $achievementService = app(AchievementService::class);
        $newlyUnlocked = $achievementService->checkSpeedAchievements($user);

        if (count($newlyUnlocked) > 0) {
            \Illuminate\Support\Facades\Log::info("Unlocked " . count($newlyUnlocked) . " speed achievements");
            foreach ($newlyUnlocked as $achievementData) {
                \Illuminate\Support\Facades\Log::info("Speed achievement unlocked: " . $achievementData['achievement']->name);
            }

            // Pass newly unlocked achievements to the session for notification
            session()->flash('achievement_unlocked', $newlyUnlocked);

            return redirect()->route('achievements.index')
                            ->with('success', 'Speed achievements unlocked successfully!');
        } else {
            \Illuminate\Support\Facades\Log::info("No new speed achievements unlocked");

            return redirect()->route('achievements.index')
                            ->with('info', 'Speed achievements test completed, but no new achievements were unlocked.');
        }
    }
}
