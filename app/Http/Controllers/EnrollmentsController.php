<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnrollmentsController extends Controller
{
    public function show(Student $student)
    {
        return Inertia::render('Enrollments/Show', [
            'enrollments' => $student->enrollments->map(function ($enrollment) {
                return [
                    'subject_code' => $enrollment->subject->subject_code,
                    'subject_description' => $enrollment->subject->description,
                    'units' => $enrollment->subject->units,
                    'semester' => $enrollment->semester,
                    'school_year' => $enrollment->academic_year,
                    'enrollment_date' => $enrollment->enrollment_date,
                    'status' => $enrollment->status,
                ];
            }),
        ]);
    }
}
