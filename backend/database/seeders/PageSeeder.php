<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Profil Sekolah',
                'slug' => 'profil-sekolah',
                'excerpt' => 'Sejarah, visi misi, dan karakter kelembagaan sekolah yang profesional.',
                'content' => '<h2>Sejarah Sekolah</h2><p>SMAN Ilum Modern dibangun sebagai institusi pendidikan menengah yang menggabungkan tata kelola profesional, budaya disiplin, dan pembelajaran adaptif.</p><h2>Visi</h2><p>Menjadi sekolah menengah unggul yang membentuk generasi berintegritas, berprestasi, dan siap menghadapi perubahan global.</p><h2>Misi</h2><ul><li>Menyelenggarakan pembelajaran berkualitas.</li><li>Menguatkan karakter dan kepemimpinan siswa.</li><li>Mendorong inovasi, literasi digital, dan kolaborasi.</li></ul>',
            ],
            [
                'title' => 'Akademik',
                'slug' => 'akademik',
                'excerpt' => 'Kurikulum, program unggulan, dan informasi pembelajaran sekolah.',
                'content' => '<h2>Kurikulum</h2><p>Sekolah menerapkan kurikulum nasional yang diperkaya pembelajaran berbasis proyek, riset, dan literasi digital.</p><h2>Program Unggulan</h2><ul><li>Pembinaan olimpiade</li><li>Literasi digital</li><li>Bimbingan karier dan perguruan tinggi</li></ul>',
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'excerpt' => 'Hubungi sekolah untuk layanan informasi publik, akademik, dan administrasi.',
                'content' => '<p>Silakan gunakan formulir kontak untuk pertanyaan, kerja sama, atau kebutuhan informasi resmi sekolah.</p>',
            ],
            [
                'title' => 'Sambutan Kepala Sekolah',
                'slug' => 'sambutan-kepala-sekolah',
                'excerpt' => 'Selamat datang di website resmi sekolah. Kami berkomitmen menghadirkan layanan pendidikan yang berkualitas, tertib, dan relevan dengan perkembangan zaman.',
                'content' => '<p>Website ini dirancang sebagai pusat informasi resmi sekolah agar siswa, orang tua, dan masyarakat memperoleh akses informasi yang cepat, jelas, dan terpercaya.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page + ['status' => 'published']);
        }
    }
}

