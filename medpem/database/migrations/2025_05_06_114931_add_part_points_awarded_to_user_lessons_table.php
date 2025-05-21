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
        Schema::table('user_lessons', function (Blueprint $table) {
            $table->boolean('part1_points_awarded')->default(false)->after('part1_completed');
            $table->boolean('part2_points_awarded')->default(false)->after('part2_completed');
            $table->boolean('part3_points_awarded')->default(false)->after('part3_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_lessons', function (Blueprint $table) {
            $table->dropColumn('part1_points_awarded');
            $table->dropColumn('part2_points_awarded');
            $table->dropColumn('part3_points_awarded');
        });
    }
};
