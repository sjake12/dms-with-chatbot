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
            'student' => $student
        ]);
    }
}
