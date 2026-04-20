<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authorId = User::query()->where('email', 'superadmin@sekolah.test')->value('id');

        $posts = [
            [
                'type' => 'news',
                'post_category_id' => PostCategory::query()->where('slug', 'berita-akademik')->value('id'),
                'title' => 'Program Literasi Digital Semester Genap Resmi Dibuka',
                'excerpt' => 'Sekolah meluncurkan penguatan literasi digital berbasis proyek untuk kelas X dan XI.',
                'show_in_slider' => true,
            ],
            [
                'type' => 'news',
                'post_category_id' => PostCategory::query()->where('slug', 'prestasi')->value('id'),
                'title' => 'Tim Olimpiade Sains Raih Juara Tingkat Kabupaten',
                'excerpt' => 'Prestasi ini memperkuat posisi sekolah sebagai institusi akademik yang kompetitif.',
                'show_in_slider' => true,
            ],
            [
                'type' => 'news',
                'post_category_id' => PostCategory::query()->where('slug', 'informasi')->value('id'),
                'title' => 'Pembukaan Pendaftaran Peserta Didik Baru 2026/2027',
                'excerpt' => 'Jadwal seleksi, alur pendaftaran, dan persyaratan administrasi telah dipublikasikan.',
                'show_in_slider' => false,
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                array_merge($post, [
                    'slug' => Str::slug($post['title']),
                    'category' => null,
                    'content' => '<p>'.$post['excerpt'].'</p><p>Konten detail dapat dikembangkan dan diedit langsung dari dashboard admin.</p>',
                    'is_featured' => true,
                    'status' => 'published',
                    'published_at' => now(),
                    'author_id' => $authorId,
                ])
            );
        }
    }
}

