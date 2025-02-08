<?php

namespace Database\Factories;

use App\Enums\RegistrationState;
use App\Enums\UserRole;
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
            'student_id' => User::all()->where('role', UserRole::STUDENT)->random()->id,
            'course_id' => Course::all()->random()->id,
            'state' => fake()->randomElement(RegistrationState::cases()),
        ];
    }
}
