<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Admin',
            'Dosen',
            'Mahasiswa',
        ];

        foreach ($roles as $namaRole) {
            Role::firstOrCreate([
                'nama_role' => $namaRole,
            ]);
        }
    }
}