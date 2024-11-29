<?php

namespace Database\Seeders;

use App\Models\Enrollments;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing enrollments
        DB::table('enrollments')->truncate();
        Student::factory(100)->create();

        // Get all students and subjects
        $students = Student::all();
        $allSubjects = Subject::where('is_active', true)->get();

        // Prepare semesters and academic years
        $semesters = ['First Semester', 'Second Semester'];
        $academicYears = ['2022-2023', '2023-2024'];

        // Enroll students in random subjects
        foreach ($students as $student) {
            // Randomly decide number of subjects (between 4 and 7)
            $subjectCount = rand(4, 7);

            // Randomly select unique subjects
            $selectedSubjects = $allSubjects->random($subjectCount);

            foreach ($selectedSubjects as $subject) {
                Enrollments::create([
                    'student_id' => $student->student_id,
                    'subject_id' => $subject->subject_id,
                    'status' => $this->randomEnrollmentStatus(),
                    'semester' => $semesters[array_rand($semesters)],
                    'academic_year' => $academicYears[array_rand($academicYears)],
                    'enrollment_date' => Carbon::now()->subDays(rand(0, 60))
                ]);
            }
        }
    }

    private function randomEnrollmentStatus(): string
    {
        $statuses = ['Enrolled', 'Ongoing', 'Completed'];
        return $statuses[array_rand($statuses)];
    }
}
