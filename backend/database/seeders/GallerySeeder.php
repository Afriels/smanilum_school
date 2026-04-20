<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Pembelajaran laboratorium terpadu',
            'Pentas seni dan budaya sekolah',
            'Latihan kepemimpinan siswa',
        ];

        foreach ($items as $index => $title) {
            $gallery = Gallery::query()->updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'description' => 'Dokumentasi kegiatan '.$title,
                    'type' => 'photo',
                    'status' => 'published',
                    'is_featured' => $index === 0,
                ]
            );

            GalleryItem::query()->updateOrCreate(
                ['album_id' => $gallery->id, 'title' => $title.' 1'],
                [
                    'file_path' => null,
                    'thumbnail_path' => null,
                    'mime_type' => 'image/jpeg',
                    'sort_order' => 0,
                ]
            );
        }
    }
}

