<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create students
        User::factory(15)->create();

        // Create profesors
        User::factory(5)->teacher()->create();

        // Create admin
        User::factory(1)->admin()->create();

        // Create unverified student
        User::factory(4)->unverified()->create();
    }
}
