<?php

use App\Http\Controllers\AcademicRecordController;
use App\Http\Controllers\EnrollmentsController;
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
    Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show');

    Route::get('/student/grade/{student}', [AcademicRecordController::class, 'show'])->name('academic-record.show');

    Route::get('/student/enrollments/{student}', [EnrollmentsController::class, 'show'])->name('enrollments.show');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
