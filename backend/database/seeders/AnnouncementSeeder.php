<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Ujian praktik kelas XII dimulai pada 24 April 2026.', 'event_date' => now()->addDays(4)->toDateString()],
            ['title' => 'Rapat komite sekolah dijadwalkan pada 29 April 2026.', 'event_date' => now()->addDays(9)->toDateString()],
            ['title' => 'Pemutakhiran data wali murid dibuka sampai 5 Mei 2026.', 'event_date' => now()->addDays(15)->toDateString()],
        ];

        foreach ($items as $item) {
            Announcement::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),
                    'excerpt' => $item['title'],
                    'content' => $item['title'],
                    'event_date' => $item['event_date'],
                    'status' => 'published',
                    'is_featured' => true,
                ]
            );
        }
    }
}

