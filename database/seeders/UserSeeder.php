<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin 1 akun asli kamu agar tetap bisa login
        User::create([
            'name' => 'Rafael Sentanu',
            'username' => '25.k1.0033@student.kampus',
            'password' => Hash::make('password123'),
            'role_id' => 3, 
            'is_active' => true,
        ]);

        // 2. Suruh Factory buat 13 data dummy secara otomatis!
        User::factory()->count(13)->create();
    }
}