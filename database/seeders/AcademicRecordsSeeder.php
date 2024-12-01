<?php

namespace Database\Seeders;

use App\Models\AcademicRecord;
use App\Models\Enrollments;
use App\Models\Faculty;
use App\Models\FacultySubject;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing academic records
        DB::table('academic_records')->truncate();

        // Get all enrollments
        $enrollments = Enrollments::all();

        foreach ($enrollments as $enrollment) {
            // Find faculties assigned to this subject
            $assignedFaculties = FacultySubject::where('subject_id', $enrollment->subject_id)
                ->where('can_assign_grades', true)
                ->pluck('faculty_id');

            // If no faculty assigned, skip this enrollment
            if ($assignedFaculties->isEmpty()) continue;

            // Randomly select a faculty from assigned faculties
            $gradingFaculty = Faculty::whereIn('faculty_id', $assignedFaculties)->inRandomOrder()->first();

            // Generate a grade (with some randomness)
            $grade = $this->generateGrade($enrollment->status);

            // Create academic record
            AcademicRecord::create([
                'student_id' => $enrollment->student_id,
                'subject_id' => $enrollment->subject_id,
                'faculty_id' => $gradingFaculty->faculty_id,
                'grade' => $grade,
                'semester' => $enrollment->semester,
                'academic_year' => $enrollment->academic_year
            ]);
        }
    }

    private function generateGrade($status): ?float
    {
        // Only generate grade for completed or ongoing statuses
        if ($status === 'Enrolled') return null;

        // Generate a random grade between 1.0 and 5.0
        // Bias towards passing grades (2.0-3.5)
        $gradeDistribution = [
            1.0, 1.25, 1.5, 1.75, 2.0, 2.25, 2.5, 2.75, 3.0
        ];
        $weights = [1, 2, 5, 7, 7, 5, 2, 1];

        $index = $this->weightedRandomChoice($gradeDistribution, $weights);
        return $gradeDistribution[$index];
    }

    // Helper method for weighted random selection
    private function weightedRandomChoice($values, $weights): int|string
    {
        $totalWeight = array_sum($weights);
        $random = mt_rand(1, $totalWeight);

        $cumulativeWeight = 0;
        foreach ($weights as $index => $weight) {
            $cumulativeWeight += $weight;
            if ($random <= $cumulativeWeight) {
                return $index;
            }
        }

        return count($values) - 1;
    }
}
