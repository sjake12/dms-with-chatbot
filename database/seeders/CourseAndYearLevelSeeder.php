<?php

namespace Database\Seeders;

use App\Models\Course;
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
       $bscs =  Course::factory()->create([
            'course_code' => 'BSCS',
            'course_description' => 'Bachelor of Science in Computer Science',
        ]);

        $bsit = Course::factory()->create([
            'course_code' => 'BSIT',
            'course_description' => 'Bachelor of Science in Information Technology',
        ]);

        $bsis = Course::factory()->create([
            'course_code' => 'BSIS',
            'course_description' => 'Bachelor of Science in Information Systems',
        ]);

        $firstYear = YearLevel::factory()->create([
            'year_level' => '1st Year',
        ]);

        $secondYear = YearLevel::factory()->create([
            'year_level' => '2nd Year',
        ]);

        $thirdYear = YearLevel::factory()->create([
            'year_level' => '3rd Year',
        ]);

        $fourthYear = YearLevel::factory()->create([
            'year_level' => '4th Year',
        ]);

        User::factory()->create([
            'id_number' => '28329',
            'username' => '28329',
            'first_name' => 'Riemy Joy',
            'last_name' => 'Martinez',
            'course' => $bscs->id,
            'year_level' => $thirdYear->id,
        ]);

        User::factory()->create([
            'id_number' => '28565',
            'username' => '28565',
            'first_name' => 'Stephen Jake',
            'last_name' => 'Apostol',
            'course' => $bscs->id,
            'year_level' => $thirdYear->id,
        ]);
    }
}
