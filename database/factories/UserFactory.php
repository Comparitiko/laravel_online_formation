<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    private function generateRandomDNI()
    {
        // Generate a random DNI number
        $dniNumbers = $this->faker->unique()->numerify('########');
        // Generate a random letter
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letter = $letters[$dniNumbers % 23];
        return $dniNumbers . $letter;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'dni' => $this->generateRandomDNI(),
            'username' => $this->faker->userName,
            'name' => $this->faker->name(),
            'surnames' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->numerify('#########'),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'specialty' => null,
            'role' => UserRole::STUDENT->value,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
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

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'address' => null,
            'city' => null,
            'specialty' => null,
            'role' => UserRole::ADMIN->value,
            'password' => static::$password ??= Hash::make('admin'),
        ]);
    }

    public function teacher(): static
    {
        return $this->state(fn (array $attributes) => [
            'address' => null,
            'city' => null,
            'specialty' => $this->faker->jobTitle,
            'role' => UserRole::TEACHER->value,
            'password' => static::$password ??= Hash::make('profesor'),
        ]);
    }
}
