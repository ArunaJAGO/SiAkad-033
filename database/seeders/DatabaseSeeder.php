<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat role terlebih dahulu
        $this->call(RoleSeeder::class);

        // 2. Cari role berdasarkan nama
        $adminRole = Role::where('nama_role', 'Admin')->firstOrFail();
        $dosenRole = Role::where('nama_role', 'Dosen')->firstOrFail();
        $mahasiswaRole = Role::where('nama_role', 'Mahasiswa')->firstOrFail();

        // 3. Buat Akun Admin (25k10033)
        User::updateOrCreate(
            ['username' => '25k10033@student.kampus'], // Email/Username untuk form login Admin
            [
                'role_id' => $adminRole->id,
                'name' => 'Rafael Sentanu Aruna Septyandaru',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'foto_profil' => null,
                'is_active' => true,
            ]
        );

        // 4. Buat Akun Dosen
        User::updateOrCreate(
            ['username' => 'budiharyadi@dosen.kampus'], // Email/Username untuk form login Dosen
            [
                'role_id' => $dosenRole->id,
                'name' => 'Budi Haryadi',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'foto_profil' => null,
                'is_active' => true,
            ]
        );

        // 5. Buat Akun Mahasiswa (25a30006)
        User::updateOrCreate(
            ['username' => '25a30006@student.kampus'], // Email/Username untuk form login Mahasiswa
            [
                'role_id' => $mahasiswaRole->id,
                'name' => 'Adelberto Orvin',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'foto_profil' => null,
                'is_active' => true,
            ]
        );

        // 6. Data Dummy Mata Kuliah & KRS
        $this->call(MataKuliahSeeder::class);
    }
}