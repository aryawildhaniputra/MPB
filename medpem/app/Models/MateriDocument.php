<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MateriDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'title',
        'file_path',
        'file_name',
        'mime_type',
        'document_type', // 'pdf', 'word', 'powerpoint'
        'size',
    ];

    /**
     * Get the materi that owns the document.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Get the full URL for the document file.
     */
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }
}
