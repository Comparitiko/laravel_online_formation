<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create students
        User::factory(10)->create();

        // Create profesors
        User::factory(2)->profesor()->create();

        // Create admin
        User::factory(1)->admin()->create();

        // Create unverified student
        User::factory(2)->unverified()->create();
    }
}
