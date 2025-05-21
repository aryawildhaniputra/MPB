<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
use App\Models\Materi;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class FixUserPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:user-points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix user points based on completed materials and lessons';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to fix user points...');

        $users = Users::all();
        $this->info('Found ' . $users->count() . ' users.');

        foreach ($users as $user) {
            $this->info('Processing user: ' . $user->name);

            // Reset points to recalculate
            $user->total_points = 0;
            $user->save();

            // Count completed materials
            $completedMaterials = DB::table('user_materi')
                ->where('user_id', $user->id)
                ->where('completed', true)
                ->get();

            $materialsPoints = $completedMaterials->count() * 5;
            $this->info('  - Completed materials: ' . $completedMaterials->count() . ' (worth ' . $materialsPoints . ' points)');

            // Update points_awarded for materials
            foreach ($completedMaterials as $material) {
                DB::table('user_materi')
                    ->where('user_id', $user->id)
                    ->where('materi_id', $material->materi_id)
                    ->update(['points_awarded' => 5]);
            }

            // Count completed lessons
            $completedLessons = DB::table('user_lessons')
                ->where('user_id', $user->id)
                ->where('completed', true)
                ->get();

            $lessonsPoints = $completedLessons->count() * 15;
            $this->info('  - Completed lessons: ' . $completedLessons->count() . ' (worth ' . $lessonsPoints . ' points)');

            // Update points_awarded for lessons
            foreach ($completedLessons as $lesson) {
                DB::table('user_lessons')
                    ->where('user_id', $user->id)
                    ->where('lesson_id', $lesson->lesson_id)
                    ->update(['points_awarded' => 15]);
            }

            // Update total points
            $totalPoints = $materialsPoints + $lessonsPoints;
            $user->total_points = $totalPoints;
            $user->save();

            $this->info('  - Total points: ' . $totalPoints);
        }

        $this->info('User points have been fixed!');

        return Command::SUCCESS;
    }
}
