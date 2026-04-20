<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Akses penuh ke seluruh modul dan pengaturan sensitif.',
            ],
            [
                'name' => 'Admin Konten',
                'slug' => 'content-admin',
                'description' => 'Mengelola sebagian besar konten dan pengaturan non-kritis.',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Membuat dan memperbarui konten editorial.',
            ],
            [
                'name' => 'Viewer',
                'slug' => 'viewer',
                'description' => 'Hanya dapat melihat dashboard dan data.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }
    }
}

