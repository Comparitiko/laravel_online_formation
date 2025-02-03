<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'duration' => fake()->numberBetween(10, 50),
            'state' => fake()->randomElement(['active', 'finished', 'cancelled']),
            'category_id' => Category::all()->random()->id,
            'teacher_id' => User::all()->where('role', 'teacher')->random()->id,
        ];
    }
}
