<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Users;
use App\Models\Lesson;
use App\Models\Achievement;
use App\Services\AchievementService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SpeedAchievementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that speed achievements are awarded correctly.
     */
    public function test_speed_achievements_are_awarded(): void
    {
        // Create a user
        $user = Users::factory()->create([
            'role' => 'user',
            'total_points' => 0
        ]);

        // Create a lesson
        $lesson = Lesson::factory()->create();

        // Create speed achievements
        $fastAchievement = Achievement::create([
            'name' => 'Kecepatan Hebat',
            'description' => 'Selesaikan bagian dalam waktu kurang dari 1 menit',
            'type' => 'speed',
            'requirement' => 60, // 60 seconds
            'icon' => 'fas fa-bolt',
            'active' => true,
            'points_reward' => 20,
        ]);

        $superFastAchievement = Achievement::create([
            'name' => 'Kecepatan Kilat',
            'description' => 'Selesaikan bagian dalam waktu kurang dari 30 detik',
            'type' => 'speed',
            'requirement' => 30, // 30 seconds
            'icon' => 'fas fa-bolt',
            'active' => true,
            'points_reward' => 30,
        ]);

        // Set up the user_lesson record with timestamps to simulate a fast completion
        $now = Carbon::now();
        $thirtySecondsAgo = $now->copy()->subSeconds(25);

        // Create a user_lesson record with a part completed in 25 seconds
        DB::table('user_lessons')->insert([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'started_at' => $thirtySecondsAgo,
            'part1_completed' => true,
            'part1_completed_at' => $now,
            'created_at' => $thirtySecondsAgo,
            'updated_at' => $now,
        ]);

        // Call the achievement service
        $achievementService = new AchievementService();
        $unlocked = $achievementService->checkAchievements($user);

        // Check that both achievements were unlocked
        $this->assertTrue($user->hasAchievement($fastAchievement->id));
        $this->assertTrue($user->hasAchievement($superFastAchievement->id));

        // The user should have earned points from the achievements
        $user->refresh(); // Get fresh data from the database
        $this->assertEquals(50, $user->total_points); // 20 + 30 points
    }

    /**
     * Test that only eligible speed achievements are awarded.
     */
    public function test_only_eligible_speed_achievements_are_awarded(): void
    {
        // Create a user
        $user = Users::factory()->create([
            'role' => 'user',
            'total_points' => 0
        ]);

        // Create a lesson
        $lesson = Lesson::factory()->create();

        // Create speed achievements
        $fastAchievement = Achievement::create([
            'name' => 'Kecepatan Hebat',
            'description' => 'Selesaikan bagian dalam waktu kurang dari 1 menit',
            'type' => 'speed',
            'requirement' => 60, // 60 seconds
            'icon' => 'fas fa-bolt',
            'active' => true,
            'points_reward' => 20,
        ]);

        $superFastAchievement = Achievement::create([
            'name' => 'Kecepatan Kilat',
            'description' => 'Selesaikan bagian dalam waktu kurang dari 30 detik',
            'type' => 'speed',
            'requirement' => 30, // 30 seconds
            'icon' => 'fas fa-bolt',
            'active' => true,
            'points_reward' => 30,
        ]);

        // Set up the user_lesson record with timestamps to simulate a slower completion (45 seconds)
        $now = Carbon::now();
        $fortyFiveSecondsAgo = $now->copy()->subSeconds(45);

        // Create a user_lesson record with a part completed in 45 seconds
        DB::table('user_lessons')->insert([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'started_at' => $fortyFiveSecondsAgo,
            'part1_completed' => true,
            'part1_completed_at' => $now,
            'created_at' => $fortyFiveSecondsAgo,
            'updated_at' => $now,
        ]);

        // Call the achievement service
        $achievementService = new AchievementService();
        $unlocked = $achievementService->checkAchievements($user);

        // Check that only the 60-second achievement was unlocked
        $this->assertTrue($user->hasAchievement($fastAchievement->id));
        $this->assertFalse($user->hasAchievement($superFastAchievement->id));

        // The user should have earned points only from the 60-second achievement
        $user->refresh(); // Get fresh data from the database
        $this->assertEquals(20, $user->total_points);
    }
}
