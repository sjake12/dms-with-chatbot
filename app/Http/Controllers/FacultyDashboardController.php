<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\AcademicRecord;
use Illuminate\Support\Facades\Auth;

class FacultyDashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->username;
        $faculty = Faculty::where('faculty_id', $id)->first();

        // Get all subjects the faculty is teaching
        $subjects = $faculty->assignedSubjects()
            ->with(['academicRecords' => function($query) {
                $query->whereNull('grade')
                    ->orWhereNotNull('grade');
            }])
            ->get()
            ->map(function ($subject) {
                return [
                    'id' => $subject->subject_id,
                    'code' => $subject->subject_code,
                    'description' => $subject->description,
                    'studentsWithoutGrades' => $subject->academicRecords
                        ->whereNull('grade')
                        ->count(),
                    'studentsWithGrades' => $subject->academicRecords
                        ->whereNotNull('grade')
                        ->count(),
                ];
            });

        $stats = [
            'totalSubjects' => $subjects->count(),
            'totalStudentsWithoutGrades' => $subjects->sum('studentsWithoutGrades'),
            'totalStudentsWithGrades' => $subjects->sum('studentsWithGrades'),
        ];

        return Inertia::render('Faculty/FacultyDashboard', [
            'subjects' => $subjects,
            'stats' => $stats,
        ]);
    }
}
