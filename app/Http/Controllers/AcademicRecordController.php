<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcademicRecordController extends Controller
{
    public function index(Student $student)
    {
        return Inertia::render('AcademicRecord/Show.jsx', [
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

    public function show(Student $student, Subject $subject)
    {
        $record = $student->academicRecords->where('subject_id', $subject->subject_id)->first();

        return Inertia::render('Faculty/Student/Show', [
            'subject' => [
                'subject_id' => $record->subject->subject_id,
                'subject_code' => $record->subject->subject_code,
                'subject_description' => $record->subject->description,
                'units' => $record->subject->units,
                'grade' => $record->grade,
                'semester' => $record->semester,
                'school_year' => $record->academic_year,
            ],
            'student' => [
                'student_id' => $student->student_id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'middle_name' => $student->middle_name,
                'program' => $student->program->program_code,
                'year_level' => $student->yearLevel->year_level,
                'email' => $student->email,
                'phone' => $student->phone_number,
                'address' => $student->address,
            ],
            'faculty' => auth()->user()->username,
        ]);
    }

    public function update(Student $student, Subject $subject)
    {
        \request()->validate([
            'grade' => 'required'
        ]);

        $academicRecord = AcademicRecord::where('student_id', $student->student_id)
            ->where('subject_id', $subject->subject_id)
            ->where('faculty_id', \request()->faculty)
            ->first();

        $academicRecord->update(['grade' => \request()->grade]);

        return redirect()->route('faculty-subject.show', ['faculty' => \request()->faculty, 'subject' => $subject->subject_id]);
    }
}
