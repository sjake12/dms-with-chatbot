<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\User;
use App\Models\YearLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseAndYearLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::factory()->create([
            'program_code' => 'BSCS',
            'program_description' => 'Bachelor of Science in Computer Science',
        ]);

        Program::factory()->create([
            'program_code' => 'BSIT',
            'program_description' => 'Bachelor of Science in Information Technology',
        ]);

        Program::factory()->create([
            'program_code' => 'BSIS',
            'program_description' => 'Bachelor of Science in Information Systems',
        ]);

        YearLevel::factory()->create([
            'year_level' => '1st Year',
        ]);

        YearLevel::factory()->create([
            'year_level' => '2nd Year',
        ]);

        YearLevel::factory()->create([
            'year_level' => '3rd Year',
        ]);

        YearLevel::factory()->create([
            'year_level' => '4th Year',
        ]);
    }
}
