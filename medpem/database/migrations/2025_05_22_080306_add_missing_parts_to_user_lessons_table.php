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
            // Add part4-6 completed columns
            $table->boolean('part4_completed')->default(false)->after('part3_completed');
            $table->boolean('part5_completed')->default(false)->after('part4_completed');
            $table->boolean('part6_completed')->default(false)->after('part5_completed');

            // Add part4-6 points_awarded columns
            $table->boolean('part4_points_awarded')->default(false)->after('part3_points_awarded');
            $table->boolean('part5_points_awarded')->default(false)->after('part4_points_awarded');
            $table->boolean('part6_points_awarded')->default(false)->after('part5_points_awarded');

            // Add part4-6 example columns
            $table->text('part4_example')->nullable()->after('part3_example');
            $table->text('part5_example')->nullable()->after('part4_example');
            $table->text('part6_example')->nullable()->after('part5_example');

            // Add timestamp columns for part completions
            $table->timestamp('part1_completed_at')->nullable()->after('part1_example');
            $table->timestamp('part2_completed_at')->nullable()->after('part2_example');
            $table->timestamp('part3_completed_at')->nullable()->after('part3_example');
            $table->timestamp('part4_completed_at')->nullable()->after('part4_example');
            $table->timestamp('part5_completed_at')->nullable()->after('part5_example');
            $table->timestamp('part6_completed_at')->nullable()->after('part6_example');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_lessons', function (Blueprint $table) {
            // Drop part4-6 columns
            $table->dropColumn([
                'part4_completed', 'part5_completed', 'part6_completed',
                'part4_points_awarded', 'part5_points_awarded', 'part6_points_awarded',
                'part4_example', 'part5_example', 'part6_example',
                'part1_completed_at', 'part2_completed_at', 'part3_completed_at',
                'part4_completed_at', 'part5_completed_at', 'part6_completed_at'
            ]);
        });
    }
};
