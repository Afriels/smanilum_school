<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'title',
        'file_path',
        'thumbnail_path',
        'mime_type',
        'sort_order',
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class, 'album_id');
    }
}

