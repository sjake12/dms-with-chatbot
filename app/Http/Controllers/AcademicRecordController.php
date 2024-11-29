<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcademicRecordController extends Controller
{
    public function show(Student $student)
    {
        return Inertia::render('AcademicRecord/Show', [
            'subjects' => $student->academicRecords->map(function ($record) {
                return [
                    'subject_code' => $record->subject->subject_code,
                    'subject_description' => $record->subject->description,
                    'units' => $record->subject->units,
                    'grade' => $record->grade,
                    'semester' => $record->semester,
                    'school_year' => $record->academic_year,
                ];
            }),
        ]);
    }
}
