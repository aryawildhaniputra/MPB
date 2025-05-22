<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('type'); // Type of achievement: bagian_completion, materi_completion, belajar_singkat_materi, points, speed
            $table->integer('requirement'); // Numeric requirement needed to unlock
            $table->string('icon')->nullable(); // Icon for the achievement
            $table->boolean('active')->default(true); // Whether this achievement is active
            $table->integer('points_reward')->default(0); // Points rewarded for unlocking
            $table->timestamps();
        });

        // Create the user_achievements pivot table
        Schema::create('user_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('achievement_id')->constrained('achievements')->onDelete('cascade');
            $table->boolean('unlocked')->default(false);
            $table->integer('points_awarded')->default(0);
            $table->timestamp('unlocked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_achievements');
        Schema::dropIfExists('achievements');
    }
};
