<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index() {}

    public function show(Student $student)
    {
        return Inertia::render('Student/Show', [
            'student' => [
               'student_id' => $student->student_id,
                'first_name' => $student->first_name,
                'middle_name' => $student->middle_name,
                'last_name' => $student->last_name,
                'program' => $student->program->program_description,
                'year_level' => $student->yearLevel->year_level,
                'email' => $student->email,
                'contact_number' => $student->phone_number,
                'address' => $student->address,
            ]
        ]);
    }
}
