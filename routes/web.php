<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view("landing_page");
});

Route::get('/login', function() {
    return view('auth.login');
});

// Role Based URL

Route::middleware(['auth', 'role:student'])->group( function () {

    Route::get('/submission/{task:slug}', [TaskController::class, 'taskSubmission'])
        ->name('student.tasksubmission');

    Route::post("/tasksubmission-upload/{task:slug}", [TaskController::class, 'taskSubmissionUpload'])
        ->name("student.tasksubmission.upload");

    Route::get('/download_resource/{task:slug}', [TaskController::class, 'getResource'])->name("student.getResource");
});

Route::middleware(['auth', 'role:teacher'])->group( function () {
    Route::get('/create_task', [TaskController::class, "showCreateTask"])->name('teacher.create_task');
    Route::post("store_task", [TaskController::class, "createTask"])->name("teacher.task_store");
});


//Shared URL

Route::middleware(['auth'])->group( function() {
    Route::get('/dashboard', [TaskController::class, 'dashboardCaller'])->name('dashboard');
    Route::get('/assignment', [TaskController::class, 'assignmentCaller'])->name('assignment');
});

require __DIR__.'/auth.php';