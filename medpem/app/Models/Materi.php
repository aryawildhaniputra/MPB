<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $fillable = ['title', 'description', 'content'];

    /**
     * The users that have accessed this materi.
     */
    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_materi', 'materi_id', 'user_id')
                    ->withPivot('progress', 'completed', 'last_accessed_at')
                    ->withTimestamps();
    }

    /**
     * Check if a user has accessed this materi.
     */
    public function isAccessedByUser($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }

    /**
     * Get the progress for a specific user.
     */
    public function getProgressForUser($userId)
    {
        $userMateri = $this->users()->where('user_id', $userId)->first();
        return $userMateri ? $userMateri->pivot->progress : 0;
    }

    /**
     * Check if a user has completed this materi.
     */
    public function isCompletedByUser($userId)
    {
        $userMateri = $this->users()->where('user_id', $userId)->first();
        return $userMateri ? $userMateri->pivot->completed : false;
    }

    /**
     * Get the documents for this materi.
     */
    public function documents()
    {
        return $this->hasMany(MateriDocument::class);
    }
}
