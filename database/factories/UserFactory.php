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
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->unique()->numerify('5208##########0###'),
            'nama_lengkap' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'no_whatsapp' => fake()->numerify('08##########'),
            'role' => 'WARGA',
            'status_akun' => 'AKTIF',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Admin Inspektorat state.
     */
    public function adminInspektorat(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'ADMIN_INSPEKTORAT',
            'status_akun' => 'AKTIF',
        ]);
    }

    /**
     * Operator Desa state.
     */
    public function operatorDesa(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'OPERATOR_DESA',
            'status_akun' => 'AKTIF',
        ]);
    }

    /**
     * Pending state.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_akun' => 'PENDING',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
