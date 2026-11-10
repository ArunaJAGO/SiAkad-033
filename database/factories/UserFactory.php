<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password = null;

    public function definition(): array
    {
        // Membuat NIM acak (misal: 25K10123) untuk dijadikan awalan email kampus
        $nimAcak = fake()->unique()->numerify('25K10###');

        return [
            'role_id' => 3, // Set otomatis ke 3 (Mahasiswa)
            'name' => fake()->name(),
            'username' => $nimAcak . '@student.kampus', // Hasil: 25K10123@student.kampus
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password123'),
            'foto_profil' => null,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }
}