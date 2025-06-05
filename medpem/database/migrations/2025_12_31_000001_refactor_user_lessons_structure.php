<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create user_lesson_parts table
        Schema::create('user_lesson_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->integer('part_number'); // 1, 2, 3, 4, 5, 6
            $table->boolean('completed')->default(false);
            $table->boolean('points_awarded')->default(false);
            $table->text('example_text')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Unique constraint to prevent duplicate parts
            $table->unique(['user_id', 'lesson_id', 'part_number']);

            // Index for better performance
            $table->index(['user_id', 'lesson_id']);
        });

        // 2. Create user_lesson_stats table
        Schema::create('user_lesson_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->integer('mistakes_count')->default(0);
            $table->integer('attempts_count')->default(1);
            $table->integer('best_time')->nullable(); // in seconds
            $table->integer('total_time')->default(0); // in seconds
            $table->timestamps();

            // Unique constraint
            $table->unique(['user_id', 'lesson_id']);
        });

        // 3. Migrate existing data from user_lessons to new tables
        $this->migrateExistingData();

        // 4. Clean up user_lessons table by removing redundant columns
        Schema::table('user_lessons', function (Blueprint $table) {
            // Remove part-specific columns
            $table->dropColumn([
                'part1_completed', 'part2_completed', 'part3_completed',
                'part4_completed', 'part5_completed', 'part6_completed',
                'part1_points_awarded', 'part2_points_awarded', 'part3_points_awarded',
                'part4_points_awarded', 'part5_points_awarded', 'part6_points_awarded',
                'part1_example', 'part2_example', 'part3_example',
                'part4_example', 'part5_example', 'part6_example',
                'part1_completed_at', 'part2_completed_at', 'part3_completed_at',
                'part4_completed_at', 'part5_completed_at', 'part6_completed_at',
                'mistakes_count' // This will be moved to stats table
            ]);
        });
    }

    /**
     * Migrate existing data from user_lessons to new normalized tables
     */
    private function migrateExistingData(): void
    {
        $userLessons = DB::table('user_lessons')->get();

        foreach ($userLessons as $userLesson) {
            $userId = $userLesson->user_id;
            $lessonId = $userLesson->lesson_id;

            // Migrate part data
            for ($i = 1; $i <= 6; $i++) {
                $completedColumn = "part{$i}_completed";
                $pointsAwardedColumn = "part{$i}_points_awarded";
                $exampleColumn = "part{$i}_example";
                $completedAtColumn = "part{$i}_completed_at";

                // Only create part record if any of the part columns exist and have data
                if (isset($userLesson->$completedColumn) ||
                    isset($userLesson->$pointsAwardedColumn) ||
                    isset($userLesson->$exampleColumn)) {

                    DB::table('user_lesson_parts')->insert([
                        'user_id' => $userId,
                        'lesson_id' => $lessonId,
                        'part_number' => $i,
                        'completed' => $userLesson->$completedColumn ?? false,
                        'points_awarded' => $userLesson->$pointsAwardedColumn ?? false,
                        'example_text' => $userLesson->$exampleColumn ?? null,
                        'completed_at' => $userLesson->$completedAtColumn ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Migrate stats data
            DB::table('user_lesson_stats')->insert([
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'mistakes_count' => $userLesson->mistakes_count ?? 0,
                'attempts_count' => 1,
                'total_time' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the dropped columns to user_lessons
        Schema::table('user_lessons', function (Blueprint $table) {
            $table->boolean('part1_completed')->default(false);
            $table->boolean('part2_completed')->default(false);
            $table->boolean('part3_completed')->default(false);
            $table->boolean('part4_completed')->default(false);
            $table->boolean('part5_completed')->default(false);
            $table->boolean('part6_completed')->default(false);

            $table->boolean('part1_points_awarded')->default(false);
            $table->boolean('part2_points_awarded')->default(false);
            $table->boolean('part3_points_awarded')->default(false);
            $table->boolean('part4_points_awarded')->default(false);
            $table->boolean('part5_points_awarded')->default(false);
            $table->boolean('part6_points_awarded')->default(false);

            $table->text('part1_example')->nullable();
            $table->text('part2_example')->nullable();
            $table->text('part3_example')->nullable();
            $table->text('part4_example')->nullable();
            $table->text('part5_example')->nullable();
            $table->text('part6_example')->nullable();

            $table->timestamp('part1_completed_at')->nullable();
            $table->timestamp('part2_completed_at')->nullable();
            $table->timestamp('part3_completed_at')->nullable();
            $table->timestamp('part4_completed_at')->nullable();
            $table->timestamp('part5_completed_at')->nullable();
            $table->timestamp('part6_completed_at')->nullable();

            $table->integer('mistakes_count')->default(0);
        });

        // Drop the new tables
        Schema::dropIfExists('user_lesson_stats');
        Schema::dropIfExists('user_lesson_parts');
    }
};
