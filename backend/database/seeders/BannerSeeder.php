<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banner = [
            'title' => 'Sekolah Modern dan Formal',
            'subtitle' => 'Platform informasi sekolah yang profesional',
            'description' => 'Fallback banner untuk beranda ketika slider featured belum diisi.',
            'primary_cta_label' => 'Lihat Profil',
            'primary_cta_url' => '/profil',
            'secondary_cta_label' => 'Kontak',
            'secondary_cta_url' => '/kontak',
            'status' => 'published',
            'is_active' => true,
            'sort_order' => 1,
        ];

        Banner::query()->updateOrCreate(
            ['slug' => Str::slug($banner['title'])],
            $banner + ['slug' => Str::slug($banner['title'])]
        );
    }
}

