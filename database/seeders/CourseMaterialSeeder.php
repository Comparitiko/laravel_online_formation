<?php

namespace Database\Seeders;

use App\Models\CourseMaterial;
use Illuminate\Database\Seeder;

class CourseMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseMaterial::factory(100)->create();
    }
}
