<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => User::all()->where('role', 'estudiante')->random()->id,
            'course_id' => Course::all()->random()->id,
            'state' => fake()->randomElement(['pendiente', 'confirmado', 'cancelado']),
        ];
    }
}
