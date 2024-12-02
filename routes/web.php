<?php

use App\Http\Controllers\AcademicRecordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyDashboardController;
use App\Http\Controllers\FacultySubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\SubjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Student Dashboard
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    // Student access
    Route::get('/student/{student}', [StudentController::class, 'index'])->name('student.index');

    Route::get('/student/grade/{student}', [AcademicRecordController::class, 'index'])->name('academic-record.index');

    Route::get('/student/enrollments/{student}', [EnrollmentsController::class, 'show'])->name('enrollments.show');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');

    // Faculty Dashboard
    Route::get('/faculty/dashboard', [FacultyDashboardController::class, 'index'])->name('faculty.dashboard');
    // faculty access
    Route::get('/faculty/{faculty}', [FacultyController::class, 'show'])->name('faculty.show');

    Route::get('/faculty/{faculty}/subjects', [FacultySubjectController::class, 'index'])->name('faculty-subject.index');
    Route::get('/faculty/{faculty}/subjects/{subject}', [FacultySubjectController::class, 'show'])->name('faculty-subject.show');

    Route::get('/student/{student}/grade/{subject}', [AcademicRecordController::class, 'show'])->name('academic-record.show');
    Route::patch('/student/{student}/grade/{subject}', [AcademicRecordController::class, 'update'])->name('faculty-subject.student.update');

    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // admin access
    Route::get('/admin/students', [AdminController::class, 'students'])->name('admin-student');
    Route::get('/admin/students/create', [AdminController::class, 'studentCreate'])->name('admin-student-create');
    Route::post('/admin/students/create', [AdminController::class, 'studentStore'])->name('admin-student-store');
    Route::get('/admin/students/{student}', [AdminController::class, 'studentShow'])->name('admin-student-show');
    Route::get('/admin/students/{student}/edit', [AdminController::class, 'studentEdit'])->name('admin-student-edit');
    Route::patch('/admin/students/{student}', [AdminController::class, 'studentUpdate'])->name('admin-student-update');
    Route::delete('/admin/students/{student}', [AdminController::class, 'studentDestroy'])->name('admin-student-destroy');

    Route::get('admin/faculties', [AdminController::class, 'faculties'])->name('admin-faculties');
    Route::get('admin/faculties/create', [AdminController::class, 'facultyCreate'])->name('admin-faculty-create');
    Route::post('admin/faculties/create', [AdminController::class, 'facultyStore'])->name('admin-faculty-store');
    Route::get('admin/faculties/{faculty}', [AdminController::class, 'facultyShow'])->name('admin-faculty-show');
    Route::get('admin/faculties/{faculty}/edit', [AdminController::class, 'facultyEdit'])->name('admin-faculty-edit');
    Route::patch('admin/faculties/{faculty}', [AdminController::class, 'facultyUpdate'])->name('admin-faculty-update');
    Route::delete('admin/faculties/{faculty}', [AdminController::class, 'facultyDestroy'])->name('admin-faculty-destroy');

    Route::get('/admin/{admin}', [AdminController::class, 'index'])->name('admin.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
