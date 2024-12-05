<?php

use App\Http\Controllers\AcademicRecordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyDashboardController;
use App\Http\Controllers\FacultySubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RasaChatBotController;
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

    // admin access
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin/students')->group(function () {
        Route::get('/', [AdminController::class, 'students'])->name('admin-student');
        Route::get('/create', [AdminController::class, 'studentCreate'])->name('admin-student-create');
        Route::post('/create', [AdminController::class, 'studentStore'])->name('admin-student-store');
        Route::get('/{student}', [AdminController::class, 'studentShow'])->name('admin-student-show');
        Route::get('/{student}/edit', [AdminController::class, 'studentEdit'])->name('admin-student-edit');
        Route::patch('/{student}', [AdminController::class, 'studentUpdate'])->name('admin-student-update');
        Route::delete('/{student}', [AdminController::class, 'studentDestroy'])->name('admin-student-destroy');
    });

    Route::prefix('admin/faculties')->group(function () {
        // Listing and Creation Routes
        Route::get('/', [AdminController::class, 'faculties'])->name('admin-faculties');
        Route::get('/create', [AdminController::class, 'facultyCreate'])->name('admin-faculty-create');
        Route::post('/create', [AdminController::class, 'facultyStore'])->name('admin-faculty-store');

        // Individual Faculty Routes
        Route::prefix('{faculty}')->group(function () {
            Route::get('/', [AdminController::class, 'facultyShow'])->name('admin-faculty-show');
            Route::get('/edit', [AdminController::class, 'facultyEdit'])->name('admin-faculty-edit');
            Route::patch('/', [AdminController::class, 'facultyUpdate'])->name('admin-faculty-update');
            Route::delete('/', [AdminController::class, 'facultyDestroy'])->name('admin-faculty-destroy');

            // Subject-related Routes
            Route::get('/subject/add', [AdminController::class, 'facultyAddSubject'])->name('admin-faculty-subject-add');
            Route::post('/subjects', [AdminController::class, 'storeFacultySubject'])->name('admin-faculty-subject-store');
        });
    });

    // API Routes
    Route::get('api/subjects', [AdminController::class, 'getSubjectSuggestions'])->name('api-subject-suggestions');

    Route::get('/admin/{admin}', [AdminController::class, 'index'])->name('admin.index');

    // Rasa Chatbot
    Route::post('/chatbot/message', [RasaChatbotController::class, 'processChatMessage']); // send user input
    Route::get('/chatbot/data', [RasaChatbotController::class, 'getChatbotData']); //
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
