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
        // Manually drop tables if they exist
        DB::statement('DROP TABLE IF EXISTS "user_hearts" CASCADE');
        DB::statement('DROP TABLE IF EXISTS "user_lessons" CASCADE');
        DB::statement('DROP TABLE IF EXISTS "questions" CASCADE');
        DB::statement('DROP TABLE IF EXISTS "lessons" CASCADE');

        // 1. Create lessons table
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_color')->default('#3B82F6');
            $table->integer('level')->default(1);
            $table->integer('position')->default(0);
            $table->integer('xp_reward')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Create questions table
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('type');
            $table->text('prompt');
            $table->string('prompt_type')->default('text');
            $table->json('options')->nullable();
            $table->json('correct_answers');
            $table->text('hint')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        // 3. Create user_lessons table
        Schema::create('user_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->integer('mistakes_count')->default(0);
            $table->integer('current_streak')->default(0);
            $table->integer('xp_earned')->default(0);
            $table->integer('progress')->default(0);
            $table->boolean('part1_completed')->default(false);
            $table->boolean('part2_completed')->default(false);
            $table->boolean('part3_completed')->default(false);
            $table->text('part1_example')->nullable();
            $table->text('part2_example')->nullable();
            $table->text('part3_example')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // 4. Create user_hearts table
        Schema::create('user_hearts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->integer('mistakes_count')->default(0);
            $table->timestamps();

            // Add unique constraint
            $table->unique(['user_id', 'lesson_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order
        Schema::dropIfExists('user_hearts');
        Schema::dropIfExists('user_lessons');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('lessons');
    }
};
