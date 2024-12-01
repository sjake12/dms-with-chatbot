<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultySubjectController extends Controller
{
    public function index(Faculty $faculty)
    {
        $faculty = Faculty::find(auth()->user()->username);
        $subjects = $faculty->assignedSubjects;

        return Inertia::render('Faculty/Subject/Index', [
            'subjects' => $subjects->map(function ($subject) {
                return [
                    'subject_id' => $subject->subject_id,
                    'subject_code' => $subject->subject_code,
                    'subject_description' => $subject->description,
                    'units' => $subject->units,
                ];
            }),
        ]);
    }

    public function show(Faculty $faculty, Subject $subject)
    {
        $class = $subject->enrollments;

        return Inertia::render('Faculty/Subject/Show', [
            'class_list' => $class->map(function ($student) use ($subject) {
                return [
                    'student_id' => $student->student_id,
                    'first_name' => $student->student->first_name,
                    'middle_name' => $student->student->middle_name,
                    'last_name' => $student->student->last_name,
                    'grade' => AcademicRecord::where('student_id', $student->student_id)
                        ->where('subject_id', $subject->subject_id)
                        ->first()
                        ->grade,
                ];
            }),
            'class' =>[
                'subject_id' => $subject->subject_id,
                'subject_code' => $subject->subject_code,
                'subject_description' => $subject->description,
            ],
        ]);
    }
}
