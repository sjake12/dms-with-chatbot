<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->username;
        $student = Student::find($id);

        // Calculate GWA (General Weighted Average)
        $gwa = DB::table('academic_records')
            ->where('student_id', $student->student_id)
            ->whereNotNull('grade')
            ->avg('grade');

        // Count currently enrolled subjects
        $currentlyEnrolledSubjects = DB::table('enrollments')
            ->where('student_id', $student->student_id)
            ->where('status', 'ENROLLED')
            ->count();

        // Count completed subjects
        $completedSubjects =DB::table('enrollments')
            ->where('student_id', $student->student_id)
            ->where('status', 'Completed')
            ->count();

        // Total subjects in prospectus (hardcoded as 52)
        $totalProspectusSubjects = 52;

        return Inertia::render('Student/StudentDashboard', [
            'studentData' => [
                'gwa' => (double) $gwa,
                'currentlyEnrolledSubjects' => (double) $currentlyEnrolledSubjects,
                'completedSubjects' => (double) $completedSubjects,
                'totalProspectusSubjects' => (double) $totalProspectusSubjects
            ]
        ]);
    }
}
