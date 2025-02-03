<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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

        // Generate a random DNI number
        $dniNumbers = $this->faker->unique()->numerify('########');
        // Generate a random letter
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letter = $letters[$dniNumbers % 23];

        return [
            'dni' => $dniNumbers . $letter,
            'name' => fake()->name(),
            'surnames' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->numerify('#########'),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'specialty' => null,
            'role' => 'student',
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
}
