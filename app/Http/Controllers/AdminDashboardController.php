<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total number of students
        $totalStudents = Student::count();

        // Number of enrolled students (current semester)
        $enrolledStudents = Student::whereHas('enrollments', function($query) {
            $query->where('semester', $this->getCurrentSemester())
                ->where('academic_year', $this->getCurrentAcademicYear());
        })->count();

        // Students per program
        $studentsPerProgram = Program::withCount('students')->get();

        // Students per year in each program
        $studentsPerProgramYear = Program::with(['students' => function($query) {
            $query->select('program_id', 'year_level', DB::raw('COUNT(*) as count'))
                ->groupBy('program_id', 'year_level');
        }])->get();

        // Average faculty load based on subject units
        $facultyLoads = Faculty::select('faculty_id', 'first_name', 'last_name')
            ->withCount(['assignedSubjects as total_units' => function($query) {
                $query->select(DB::raw('SUM(units)'));
            }])
            ->get()
            ->map(function($faculty) {
                $faculty->average_load = $faculty->total_units / Subject::count();
                return $faculty;
            });

        return Inertia::render('Admin/AdminDashboard', [
            'totalStudents' => $totalStudents,
            'enrolledStudents' => $enrolledStudents,
            'studentsPerProgram' => $studentsPerProgram,
            'studentsPerProgramYear' => $studentsPerProgramYear,
            'facultyLoads' => $facultyLoads
        ]);
    }

    private function getCurrentSemester()
    {
        // Implement logic to determine current semester (e.g., 'First Semester', 'Second Semester')
        $currentMonth = now()->month;
        return $currentMonth >= 6 && $currentMonth <= 11 ? 'First Semester' : 'Second Semester';
    }

    private function getCurrentAcademicYear()
    {
        // Implement logic to determine current academic year
        $currentMonth = now()->month;
        $currentYear = now()->year;
        return $currentMonth >= 6 ? $currentYear . '-' . ($currentYear + 1) : ($currentYear - 1) . '-' . $currentYear;
    }
}
