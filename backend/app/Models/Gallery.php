<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery_albums';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image_path',
        'type',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class, 'album_id');
    }
}

