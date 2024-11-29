<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing faculty-subject assignments
        DB::table('faculty_subject')->delete();
        Faculty::factory(15)->create();

        // Get all subjects and faculties
        $subjects = Subject::all();
        $faculties = Faculty::all();

        // Categorize subjects by type
        $subjectCategories = [
            'core_cs' => [
                'CS111', 'CS121', 'CS122', 'CS211', 'CS221',
                'AC221', 'PL222', 'ALT312', 'SE314', 'SE324',
                'CS400', 'CS450', 'Data Structures and Algorithms',
                'Object-Oriented Programming', 'Programming Languages'
            ],
            'programming' => [
                'CC112', 'CS121', 'PF211', 'CC116',
                'Application Development and Emerging Technologies'
            ],
            'math_and_stats' => [
                'GE701', 'MATH005', 'MATH110', 'STAT003',
                'Mathematics in the Modern World', 'Analytical Geometry', 'Calculus'
            ],
            'general_education' => [
                'GE702', 'GE703', 'GE704', 'GE705', 'GE706',
                'GE707', 'GE708', 'GE709', 'GE711', 'GE712', 'GE713', 'GE715',
                'Purposive Communication', 'Ethics', 'Science, Technology and Society',
                'The Contemporary World', 'Art Appreciation'
            ],
            'specialized_tech' => [
                'AI215', 'AR214', 'CC115', 'HCI316', 'IAS327',
                'NC225', 'OS223', 'Information Management',
                'Human Computer Interaction', 'Networks and Communications'
            ],
            'research_and_professional' => [
                'RES111', 'SE314', 'SE324', 'SPI411', 'CS Thesis Writing',
                'Advanced Technical Writing', 'CS Research Methods'
            ]
        ];

        // Ensure we have enough faculties
        if ($faculties->count() < 5) {
            throw new \Exception("Not enough faculties. Please seed more faculties before running this seeder.");
        }

        // Distribute subjects across faculties with some specialization
        $faculties->each(function ($faculty, $index) use ($subjects, $subjectCategories) {
            // Create a specialization for each faculty
            $specializations = array_keys($subjectCategories);
            $facultySpecialization = $specializations[$index % count($specializations)];

            // Select subjects based on specialization
            $assignedSubjectIds = $subjects
                ->filter(function ($subject) use ($subjectCategories, $facultySpecialization) {
                    // Prioritize subjects in the faculty's specialization
                    return collect($subjectCategories[$facultySpecialization])
                        ->contains(fn($code) =>
                            stripos($subject->subject_code, $code) !== false ||
                            stripos($subject->description, $code) !== false
                        );
                })
                ->pluck('subject_id')
                ->toArray();

            // Randomly add some additional subjects to ensure variety
            $additionalSubjects = $subjects
                ->except($assignedSubjectIds)
                ->random(max(3, round($subjects->count() * 0.1))) // Add 10% more subjects or at least 3
                ->pluck('subject_id')
                ->toArray();

            $allSubjectIds = array_merge($assignedSubjectIds, $additionalSubjects);

            // Attach subjects with random grade assignment permission
            foreach ($allSubjectIds as $subjectId) {
                DB::table('faculty_subject')->insert([
                    'faculty_id' => $faculty->faculty_id,
                    'subject_id' => $subjectId,
                    'can_assign_grades' => rand(0, 1) == 1, // 50% chance of grade assignment
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        });
    }
}
