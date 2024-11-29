<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\Enrollments;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $studentId = auth()->user()->username ?? null;

        return Inertia::render('Subjects/Index', [
            'subjects' => $subjects->map(function ($subject) use ($studentId) {
                return [
                    'code' => $subject->subject_code,
                    'description' => $subject->description,
                    'units' => $subject->units,
                    'grade' => AcademicRecord::where('subject_id', $subject->subject_id)->where('student_id', $studentId)->first()->grade ?? null,
                ];
            }),
        ]);
    }
}
