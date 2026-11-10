<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Anda)
        User::updateOrCreate(
            ['username' => '25k10033@student.kampus'], // Kolom unik untuk pengecekan
            [
                'role_id' => 1,
                'name' => 'Rafael Sentanu Aruna Septyandaru',
                'password' => Hash::make('password123'),
                'foto_profil' => 'uploads/profil/033.jpg', 
                'is_active' => true,
            ]
        );

        // 2. Akun Dosen (Pak Budi Haryadi)
        User::updateOrCreate(
            ['username' => 'budiharyadi@dosen.kampus'], 
            [
                'role_id' => 2, 
                'name' => 'Budi Haryadi',
                'password' => Hash::make('password123'),
                'foto_profil' => null, 
                'is_active' => true,
            ]
        );

        // 3. Akun Mahasiswa (Leon)
        User::updateOrCreate(
            ['username' => '25a30006@student.kampus'], 
            [
                'role_id' => 3, 
                'name' => 'Adelberto Orvin',
                'password' => Hash::make('password123'),
                'foto_profil' => null, 
                'is_active' => true,
            ]
        );
    }
}