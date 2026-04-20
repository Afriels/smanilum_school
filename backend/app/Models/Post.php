<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'post_category_id',
        'category',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image_path',
        'is_featured',
        'show_in_slider',
        'status',
        'published_at',
        'author_id',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'show_in_slider' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categoryRecord(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
