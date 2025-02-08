<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::all()->random()->id,
            'student_id' => User::all()->where('role', UserRole::STUDENT->value)->random()->id,
            'final_note' => fake()->randomFloat(1, 0, 10),
            'comments' => fake()->paragraph(2),
        ];
    }
}
