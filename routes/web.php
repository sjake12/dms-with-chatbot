<?php

use App\Http\Controllers\AcademicRecordController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultySubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Student access
    Route::get('/student/{student}', [StudentController::class, 'index'])->name('student.index');

    Route::get('/student/grade/{student}', [AcademicRecordController::class, 'index'])->name('academic-record.index');

    Route::get('/student/enrollments/{student}', [EnrollmentsController::class, 'show'])->name('enrollments.show');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');

    // faculty access
    Route::get('/faculty/{faculty}', [FacultyController::class, 'show'])->name('faculty.show');

    Route::get('/faculty/{faculty}/subjects', [FacultySubjectController::class, 'index'])->name('faculty-subject.index');
    Route::get('/faculty/{faculty}/subjects/{subject}', [FacultySubjectController::class, 'show'])->name('faculty-subject.show');

    Route::get('/student/{student}/grade/{subject}', [AcademicRecordController::class, 'show'])->name('academic-record.show');
    Route::patch('/student/{student}/grade/{subject}', [AcademicRecordController::class, 'update'])->name('faculty-subject.student.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
