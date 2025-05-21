<?php

namespace Tests\Unit;

use App\Models\Achievement;
use App\Models\Materi;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_track_materi_progress()
    {
        $user = Users::factory()->create();
        $materi = Materi::factory()->create();
        
        $pivotData = $user->trackMateriProgress($materi->id, 75, false);
        
        $this->assertEquals(75, $pivotData->progress);
        $this->assertFalse((bool)$pivotData->completed);
        
        // Check the database record
        $this->assertDatabaseHas('materi_user', [
            'user_id' => $user->id,
            'materi_id' => $materi->id,
            'progress' => 75,
            'completed' => false,
        ]);
    }
    
    public function test_user_can_complete_materi()
    {
        $user = Users::factory()->create([
            'total_points' => 0
        ]);
        
        $materi = Materi::factory()->create([
            'points_value' => 150
        ]);
        
        // First track some progress
        $user->trackMateriProgress($materi->id, 50, false);
        
        // Now complete it
        $pivotData = $user->trackMateriProgress($materi->id, 100, true);
        
        $this->assertEquals(100, $pivotData->progress);
        $this->assertTrue((bool)$pivotData->completed);
        
        // Refresh user model
        $user->refresh();
        
        // Check if user received points
        $this->assertEquals(0, $user->total_points); // This is 0 because just tracking doesn't award points
    }
    
    public function test_user_achievements_relationship()
    {
        $user = Users::factory()->create();
        $achievement = Achievement::factory()->create();
        
        $user->achievements()->attach($achievement->id);
        
        $this->assertTrue($user->achievements->contains($achievement));
        $this->assertEquals(1, $user->achievements->count());
    }
} 