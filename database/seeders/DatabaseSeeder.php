<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CourseAndYearLevelSeeder::class,
            SubjectSeeder::class,
            RoleAndPermissionSeeder::class,
            FacultySubjectSeeder::class,
        ]);

        Student::factory(100)->create();

        Admin::factory()->create([
            'admin_id' => '12345',
            'first_name' => 'Riemy Joy',
            'middle_name' => 'Dalisay',
            'last_name' => 'Martinez',
            'position' => 'Administrator',
        ]);

        Admin::factory()->create([
            'admin_id' => '12344',
            'first_name' => 'Hannah',
            'middle_name' => 'Tanggol',
            'last_name' => 'Alegrid',
            'position' => 'Administrator',
        ]);
    }
}
