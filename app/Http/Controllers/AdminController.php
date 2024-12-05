<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Admin $admin)
    {
        return Inertia::render('Admin/Index', [
            'admin' => [
                'admin_id' => $admin->admin_id,
                'first_name' => $admin->first_name,
                'middle_name' => $admin->middle_name,
                'last_name' => $admin->last_name,
                'position' => $admin->position,
            ]
        ]);
    }

    public function students()
    {
        $students = Student::all();

        return Inertia::render('Admin/Students/Index', [
           'students' => $students->map(function ($student) {
               return [
                   'student_id' => $student->student_id,
                   'first_name' => $student->first_name,
                   'middle_name' => $student->middle_name,
                   'last_name' => $student->last_name,
                   'program' => $student->program->program_code,
                   'year_level' => $student->yearLevel->year_level,
                   'email' => $student->email,
                   'phone' => $student->phone_number,
                   'address' => $student->address,
               ];
           }),
        ]);
    }

    public function studentShow(Student $student)
    {
        $enrollments = $student->enrollments;

        return Inertia::render('Admin/Students/Show', [
            'student' => [
                'student_id' => $student->student_id,
                'first_name' => $student->first_name,
                'middle_name' => $student->middle_name,
                'last_name' => $student->last_name,
                'program' => $student->program->program_description,
                'year_level' => $student->yearLevel->year_level,
                'email' => $student->email,
                'phone' => $student->phone_number,
                'address' => $student->address,
            ],
            'enrollments' => $enrollments->map(function ($enrollment) {
                return [
                    'enrollment_id' => $enrollment->enrollment_id,
                    'subject_code' => $enrollment->subject->subject_code,
                    'subject_description' => $enrollment->subject->description,
                    'units' => $enrollment->subject->units,
                    'semester' => $enrollment->semester,
                    'school_year' => $enrollment->academic_year,
                ];
            })
        ]);
    }

    public function studentCreate()
    {
        return Inertia::render('Admin/Students/Create', [
            'programs' => Program::all(),
            'yearLevels' => YearLevel::all()
        ]);
    }

    public function studentStore()
    {
        $validated = \request()->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'program_id' => 'required',
            'year_level_id' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        Student::create([
            'student_id' => (int) \request()->student_id,
            'first_name' => \request()->first_name,
            'middle_name' => \request()->middle_name,
            'last_name' => \request()->last_name,
            'program_id' => (int) \request()->program_id,
            'year_level' => (int) \request()->year_level_id,
            'email' => \request()->email,
            'phone_number' => \request()->phone_number,
            'address' => \request()->address,
        ]);

        return redirect()->route('admin-student');
    }

    public function studentEdit(Student $student)
    {
        return Inertia::render('Admin/Students/Edit', [
            'student' => [
                'student_id' => $student->student_id,
                'first_name' => $student->first_name,
                'middle_name' => $student->middle_name,
                'last_name' => $student->last_name,
                'program_id' => $student->program->program_id,
                'year_level_id' => $student->yearLevel->year_level_id,
                'email' => $student->email,
                'phone_number' => $student->phone_number,
                'address' => $student->address,
            ],
            'programs' => Program::all(),
            'yearLevels' => YearLevel::all()
        ]);
    }

    public function studentUpdate(Student $student)
    {
        $validated = \request()->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'program_id' => 'required',
            'year_level_id' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        $student->update([
            'first_name' => \request()->first_name,
            'middle_name' => \request()->middle_name,
            'last_name' => \request()->last_name,
            'program_id' => (int) \request()->program_id,
            'year_level' => (int) \request()->year_level_id,
            'email' => \request()->email,
            'phone_number' => \request()->phone_number,
            'address' => \request()->address,
        ]);

        return redirect()->route('admin-student-show', ['student' => $student->student_id]);
    }

    public function studentDestroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin-student')->with('message', 'Student deleted successfully');
    }

    public function faculties()
    {
        $faculties = Faculty::all();

        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties->map(function ($faculty) {
                return [
                    'faculty_id' => $faculty->faculty_id,
                    'first_name' => $faculty->first_name,
                    'middle_name' => $faculty->middle_name,
                    'last_name' => $faculty->last_name,
                    'email' => $faculty->email,
                    'phone_number' => $faculty->phone_number,
                    'address' => $faculty->address,
                ];
            }),
        ]);
    }

    public function facultyCreate()
    {
        return Inertia::render('Admin/Faculty/Create');
    }

    public function facultyStore()
    {
        \request()->validate([
            'faculty_id' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        Faculty::create([
            'faculty_id' => (int) \request()->faculty_id,
            'first_name' => \request()->first_name,
            'middle_name' => \request()->middle_name,
            'last_name' => \request()->last_name,
            'email' => \request()->email,
            'phone_number' => \request()->phone_number,
            'address' => \request()->address,
        ]);

        return redirect()->route('admin-faculties');
    }

    public function facultyShow(Faculty $faculty)
    {
        $subjects = $faculty->assignedSubjects;

        return Inertia::render('Admin/Faculty/Show', [
            'faculty' => [
                'faculty_id' => $faculty->faculty_id,
                'first_name' => $faculty->first_name,
                'middle_name' => $faculty->middle_name,
                'last_name' => $faculty->last_name,
                'email' => $faculty->email,
                'phone_number' => $faculty->phone_number,
                'address' => $faculty->address,
            ],
            'facultySubjects' => $subjects->map(function ($subject) {
                return [
                    'subject_id' => $subject->subject_id,
                    'subject_code' => $subject->subject_code,
                    'description' => $subject->description,
                    'units' => $subject->units,
                ];
            }),
        ]);
    }

    public function facultyEdit(Faculty $faculty)
    {
        return Inertia::render('Admin/Faculty/Edit', [
            'faculty' => [
                'faculty_id' => $faculty->faculty_id,
                'first_name' => $faculty->first_name,
                'middle_name' => $faculty->middle_name,
                'last_name' => $faculty->last_name,
                'email' => $faculty->email,
                'phone_number' => $faculty->phone_number,
                'address' => $faculty->address,
            ],
        ]);
    }

    public function facultyUpdate(Faculty $faculty)
    {
        \request()->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        $faculty->update([
            'first_name' => \request()->first_name,
            'middle_name' => \request()->middle_name,
            'last_name' => \request()->last_name,
            'email' => \request()->email,
            'phone_number' => \request()->phone_number,
            'address' => \request()->address,
        ]);

        return redirect()->route('admin-faculty-show', ['faculty' => $faculty->faculty_id]);
    }

    public function facultyDestroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect()->route('admin-faculties')->with('message', 'Faculty deleted successfully');
    }

    public function facultyAddSubject(Faculty $faculty)
    {
        // Get all subjects that haven't been assigned to this faculty
        $availableSubjects = Subject::whereNotIn('subject_id',
            $faculty->assignedSubjects()->pluck('subjects.subject_id')
        )->get();

        return Inertia::render('Admin/Faculty/AddSubject', [
            'faculty' => $faculty,
            'subjects' => $availableSubjects
        ]);
    }

    /**
     * Store a new subject-faculty relationship
     *
     * @param Request $request
     * @param Faculty $faculty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFacultySubject(Request $request, Faculty $faculty)
    {
        $request->validate([
            'subject_id' => [
                'nullable',
                'exists:subjects,subject_id',
            ],
            'subject_code' => 'required|string|max:255',
            'description' => 'required|string',
            'units' => 'required|integer|min:1|max:10'
        ]);

        try {
            // If subject_id is not provided, create a new subject
            if (!$request->subject_id) {
                $subject = Subject::create([
                    'subject_code' => $request->subject_code,
                    'description' => $request->description,
                    'units' => $request->units,
                    'is_active' => true
                ]);
                $subjectId = $subject->subject_id;
            } else {
                $subjectId = $request->subject_id;
            }

            // Check if the subject is already assigned to the faculty
            $existingAssignment = $faculty->subjects()->where('subjects.subject_id', $subjectId)->exists();

            if (!$existingAssignment) {
                // Attach the subject to the faculty
                $faculty->subjects()->attach($subjectId, [
                    'can_assign_grades' => true
                ]);
            }

            return redirect()->route('admin-faculty-show', $faculty)
                ->with('success', 'Subject successfully assigned to faculty');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error assigning subject to faculty']);
        }
    }

    /**
     * Get subjects for autocomplete (API endpoint)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubjectSuggestions()
    {
        $subjects = Subject::select('subject_id', 'subject_code', 'description', 'units')
            ->where('is_active', true)
            ->get();

        return response()->json($subjects);
    }
}
