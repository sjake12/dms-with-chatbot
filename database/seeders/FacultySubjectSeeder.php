<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class FacultySubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing faculty-subject assignments
        DB::table('faculty_subject')->delete();
        Faculty::factory(10)->create();

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

        // Shuffle faculties and subjects to distribute randomness
        $shuffledFaculties = $faculties->shuffle();
        $shuffledSubjects = $subjects->shuffle();

        // Track assigned subject IDs to ensure each subject is assigned to only one faculty
        $assignedSubjectIds = collect();

        // Ensure every faculty gets at least one subject
        $shuffledFaculties->each(function ($faculty) use ($shuffledFaculties, $shuffledSubjects, $subjectCategories, &$assignedSubjectIds) {
            // Create a specialization for each faculty
            $specializations = array_keys($subjectCategories);
            $facultySpecialization = $specializations[array_search($faculty->name, $shuffledFaculties->pluck('name')->toArray()) % count($specializations)];

            // Find an available subject
            $availableSubjects = $shuffledSubjects->whereNotIn('subject_id', $assignedSubjectIds);

            // Prioritize subjects in the faculty's specialization
            $specializedSubjects = $availableSubjects->filter(function ($subject) use ($subjectCategories, $facultySpecialization) {
                return collect($subjectCategories[$facultySpecialization])
                    ->contains(fn($code) =>
                        stripos($subject->subject_code, $code) !== false ||
                        stripos($subject->description, $code) !== false
                    );
            });

            // Select a subject for the faculty
            $selectedSubject = $specializedSubjects->first() ?? $availableSubjects->first();

            if (!$selectedSubject) {
                throw new \Exception("Not enough subjects to assign to all faculties.");
            }

            // Attach the subject to the faculty
            DB::table('faculty_subject')->insert([
                'faculty_id' => $faculty->faculty_id,
                'subject_id' => $selectedSubject->subject_id,
                'can_assign_grades' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Track the assigned subject
            $assignedSubjectIds->push($selectedSubject->subject_id);
        });

        // If there are remaining subjects, distribute them to faculties
        $remainingSubjects = $shuffledSubjects->whereNotIn('subject_id', $assignedSubjectIds);
        $facultyIndex = 0;

        foreach ($remainingSubjects as $subject) {
            $faculty = $shuffledFaculties[$facultyIndex];

            DB::table('faculty_subject')->insert([
                'faculty_id' => $faculty->faculty_id,
                'subject_id' => $subject->subject_id,
                'can_assign_grades' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $facultyIndex = ($facultyIndex + 1) % $shuffledFaculties->count();
        }
    }
}
