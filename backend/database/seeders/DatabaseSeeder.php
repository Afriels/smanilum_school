<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            SiteSettingSeeder::class,
            AdminUserSeeder::class,
            PostCategorySeeder::class,
            PageSeeder::class,
            BannerSeeder::class,
            AnnouncementSeeder::class,
            ExtracurricularSeeder::class,
            GallerySeeder::class,
            PostSeeder::class,
        ]);
    }
}
