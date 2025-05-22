<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Log;
use App\Models\Users;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Create a custom log file
$logFile = fopen('speed_test.log', 'w');

function log_output($message) {
    global $logFile;
    $msg = date('Y-m-d H:i:s') . ' - ' . $message . "\n";
    echo $msg;
    fwrite($logFile, $msg);
}

// Get first user
$user = Users::first();
if (!$user) {
    log_output("No users found");
    exit;
}
log_output("Testing with user: {$user->id}");

// Get first lesson
$lesson = Lesson::first();
if (!$lesson) {
    log_output("No lessons found");
    exit;
}
log_output("Testing with lesson: {$lesson->id}");

// Create test data for speed achievement
$startedAt = Carbon::now()->subMinutes(1); // Started 1 minute ago
$completedAt = Carbon::now()->subSeconds(20); // Completed 20 seconds later (fast)

// Update database record
try {
    // Check if user already has this lesson
    $existingRecord = DB::table('user_lessons')
        ->where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->first();

    if ($existingRecord) {
        // Update existing record
        DB::table('user_lessons')
            ->where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->update([
                'started_at' => $startedAt,
                'part1_completed' => true,
                'part1_completed_at' => $completedAt,
                'updated_at' => Carbon::now()
            ]);
        log_output("Updated existing record with speed data");
    } else {
        // Create new record
        DB::table('user_lessons')->insert([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'started_at' => $startedAt,
            'part1_completed' => true,
            'part1_completed_at' => $completedAt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        log_output("Created new record with speed data");
    }

    // Get record to verify
    $record = DB::table('user_lessons')
        ->where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->first();

    log_output("Record details:");
    log_output("  started_at: " . $record->started_at);
    log_output("  part1_completed: " . ($record->part1_completed ? 'true' : 'false'));
    log_output("  part1_completed_at: " . $record->part1_completed_at);

    // Calculate time difference
    $start = Carbon::parse($record->started_at);
    $end = Carbon::parse($record->part1_completed_at);
    $seconds = $end->diffInSeconds($start);

    log_output("  Time difference: {$seconds} seconds");
    log_output("  Started at: " . $start->toDateTimeString());
    log_output("  Completed at: " . $end->toDateTimeString());

    // Force a very fast completion time
    $startedAt = Carbon::now()->subMinutes(5);
    $completedAt = Carbon::now()->subMinutes(5)->addSeconds(15); // Completed in just 15 seconds

    // Update the record with extremely fast time
    DB::table('user_lessons')
        ->where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->update([
            'started_at' => $startedAt,
            'part1_completed' => true,
            'part1_completed_at' => $completedAt,
            'updated_at' => Carbon::now()
        ]);

    log_output("Updated record with extremely fast completion time (15 seconds)");

    // Get record to verify
    $record = DB::table('user_lessons')
        ->where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->first();

    // Calculate time difference again
    $start = Carbon::parse($record->started_at);
    $end = Carbon::parse($record->part1_completed_at);
    $seconds = $end->diffInSeconds($start);

    log_output("New time difference: {$seconds} seconds");
    log_output("New started at: " . $start->toDateTimeString());
    log_output("New completed at: " . $end->toDateTimeString());
    log_output("Part1 completed: " . ($record->part1_completed ? 'true' : 'false'));

    // Check for speed achievements in database
    log_output("Checking for speed achievements in database...");
    $speedAchievements = DB::table('achievements')
        ->where('type', 'speed')
        ->get();

    log_output("Found " . $speedAchievements->count() . " speed achievements:");
    foreach ($speedAchievements as $achievement) {
        log_output("  - {$achievement->name} (req: {$achievement->requirement}s)");
    }

    // Check for speed achievements
    $achievementService = app(\App\Services\AchievementService::class);
    log_output("Checking speed achievements...");
    $achievements = $achievementService->checkSpeedAchievements($user);

    if (count($achievements) > 0) {
        log_output("Unlocked " . count($achievements) . " speed achievements:");
        foreach ($achievements as $achievement) {
            log_output("  - " . $achievement['achievement']->name);
        }
    } else {
        log_output("No speed achievements were unlocked");

        // Check if user already has the achievements
        $userAchievements = DB::table('user_achievements')
            ->where('user_id', $user->id)
            ->join('achievements', 'achievements.id', '=', 'user_achievements.achievement_id')
            ->where('achievements.type', 'speed')
            ->get();

        if ($userAchievements->count() > 0) {
            log_output("User already has " . $userAchievements->count() . " speed achievements:");
            foreach ($userAchievements as $achievement) {
                log_output("  - {$achievement->name}");
            }
        } else {
            log_output("User has no speed achievements");
        }
    }

    // The issue might be that the model relationships aren't properly loaded
    // Let's reload the user to refresh the relationships
    $user = Users::find($user->id);

} catch (\Exception $e) {
    log_output("Error: " . $e->getMessage());
    log_output($e->getTraceAsString());
}

log_output("Done");
fclose($logFile);
