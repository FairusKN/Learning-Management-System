<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view("landing_page");
});

Route::get('/login', function() {
    return view('auth.login');
});

Route::middleware(['auth', 'verified', 'role:student'])->group( function () {
    Route::get('/dashboard-student', [TaskController::class, 'indexStudent'])
        ->name('student.dashboard');

    Route::get('/submission/{task_id}', [TaskController::class, 'taskSubmission'])
        ->name('student.tasksubmission');
    Route::post("/tasksubmissionupload/{task_id}", [TaskController::class, 'taskSubmissionUpload'])
        ->name("student.tasksubmission.upload");

    Route::get('/assignment', [TaskController::class, 'showTask'])
        ->name("student.assignment");
});

Route::middleware(['auth', 'verified', 'role:teacher'])->group( function () {
    Route::get('/dashboard-teacher', [TaskController::class, 'indexTeacher'])
        ->name('teacher.dashboard');
    Route::get('/assignment', [TaskController::class, 'showTask'])
        ->name("teacher.assignment");
});


require __DIR__.'/auth.php';
