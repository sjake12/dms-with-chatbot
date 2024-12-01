<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultyController extends Controller
{
    public function show(Faculty $faculty)
    {
        return Inertia::render('Faculty/Show', [
            'faculty' => [
                'faculty_id' => $faculty->faculty_id,
                'first_name' => $faculty->first_name,
                'middle_name' => $faculty->middle_name,
                'last_name' => $faculty->last_name,
                'email' => $faculty->email,
                'phone_number' => $faculty->phone_number,
                'address' => $faculty->address,
            ]
        ]);
    }
}
