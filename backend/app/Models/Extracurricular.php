<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $table = 'extracurriculars';

    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'cover_image',
        'featured_image_path',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}

