<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExtracurricularSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Paskibra', 'summary' => 'Pembinaan disiplin, kepemimpinan, dan kerja tim.', 'description' => 'Ekstrakurikuler paskibra melatih kedisiplinan, ketahanan mental, dan kepemimpinan siswa.'],
            ['name' => 'Karya Ilmiah Remaja', 'summary' => 'Riset dan inovasi siswa.', 'description' => 'Siswa dibina dalam metode penelitian, presentasi, dan kompetisi ilmiah.'],
            ['name' => 'Basket', 'summary' => 'Pembinaan teknik dan sportivitas.', 'description' => 'Latihan teknik bermain, kebugaran, dan partisipasi turnamen antar sekolah.'],
            ['name' => 'Jurnalistik', 'summary' => 'Menulis, fotografi, dan dokumentasi kegiatan.', 'description' => 'Mengembangkan kemampuan peliputan, penulisan berita, dan produksi media sekolah.'],
        ];

        foreach ($items as $item) {
            Extracurricular::query()->updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'summary' => $item['summary'],
                    'description' => $item['description'],
                    'status' => 'published',
                    'is_featured' => true,
                ]
            );
        }
    }
}

