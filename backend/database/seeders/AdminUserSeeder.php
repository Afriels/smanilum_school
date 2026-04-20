<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRoleId = Role::query()->where('slug', 'super-admin')->value('id');
        $editorRoleId = Role::query()->where('slug', 'editor')->value('id');

        User::updateOrCreate(
            ['email' => 'superadmin@sekolah.test'],
            [
                'name' => 'Super Admin',
                'role_id' => $superAdminRoleId,
                'is_active' => true,
                'two_factor_enabled' => false,
                'password' => Hash::make('ChangeMe123!'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'editor@sekolah.test'],
            [
                'name' => 'Editor Konten',
                'role_id' => $editorRoleId,
                'is_active' => true,
                'two_factor_enabled' => false,
                'password' => Hash::make('ChangeMe123!'),
            ]
        );
    }
}
