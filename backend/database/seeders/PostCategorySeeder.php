<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Berita Akademik', 'Prestasi', 'Informasi', 'Kegiatan Siswa'] as $name) {
            PostCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => 'Kategori '.$name,
                ]
            );
        }
    }
}

