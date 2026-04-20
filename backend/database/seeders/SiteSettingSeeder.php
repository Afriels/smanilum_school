<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['group' => 'identity', 'key' => 'site_name', 'value' => 'SMAN Ilum Modern', 'type' => 'text', 'is_public' => true],
            ['group' => 'identity', 'key' => 'site_tagline', 'value' => 'Sekolah Unggul, Berkarakter, dan Siap Menyongsong Masa Depan', 'type' => 'text', 'is_public' => true],
            ['group' => 'identity', 'key' => 'site_description', 'value' => 'Website sekolah modern, formal, responsif, aman, dan SEO-friendly.', 'type' => 'textarea', 'is_public' => true],
            ['group' => 'identity', 'key' => 'default_og_image', 'value' => 'images/default.jpg', 'type' => 'text', 'is_public' => true],
            ['group' => 'branding', 'key' => 'logo', 'value' => null, 'type' => 'file', 'is_public' => true],
            ['group' => 'branding', 'key' => 'favicon', 'value' => null, 'type' => 'file', 'is_public' => true],
            ['group' => 'contact', 'key' => 'address', 'value' => 'Jl. Pendidikan Nusantara No. 10, Kabupaten Lumina, Jawa Timur', 'type' => 'textarea', 'is_public' => true],
            ['group' => 'contact', 'key' => 'phone', 'value' => '(0334) 765432', 'type' => 'text', 'is_public' => true],
            ['group' => 'contact', 'key' => 'email', 'value' => 'info@smanilum.test', 'type' => 'text', 'is_public' => true],
            ['group' => 'contact', 'key' => 'facebook_url', 'value' => '#', 'type' => 'text', 'is_public' => true],
            ['group' => 'contact', 'key' => 'instagram_url', 'value' => '#', 'type' => 'text', 'is_public' => true],
            ['group' => 'contact', 'key' => 'youtube_url', 'value' => '#', 'type' => 'text', 'is_public' => true],
            ['group' => 'contact', 'key' => 'map_embed_url', 'value' => 'https://www.google.com/maps?q=Jakarta&output=embed', 'type' => 'text', 'is_public' => true],
            ['group' => 'identity', 'key' => 'student_count', 'value' => '1.240+', 'type' => 'text', 'is_public' => true],
            ['group' => 'identity', 'key' => 'teacher_count', 'value' => '68', 'type' => 'text', 'is_public' => true],
            ['group' => 'identity', 'key' => 'extracurricular_count', 'value' => '24', 'type' => 'text', 'is_public' => true],
            ['group' => 'identity', 'key' => 'graduation_rate', 'value' => '92%', 'type' => 'text', 'is_public' => true],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
