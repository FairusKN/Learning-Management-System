<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\student\StudentTaskController;
use App\Http\Controllers\teacher\TeacherTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("landing_page");
});

Route::get('/login', function() {
    return view('auth.login');
});

// Role Based URL

Route::middleware(['auth', 'role:student'])->group( function () {

    Route::get('/submission/{task:slug}', [StudentTaskController::class, 'taskSubmission'])
        ->name('student.tasksubmission');

    Route::post("/tasksubmission-upload/{task:slug}", [StudentTaskController::class, 'taskSubmissionUpload'])
        ->name("student.tasksubmission.upload");
});

Route::middleware(['auth', 'role:teacher'])->group( function () {
    Route::get('/create_task', [TeacherTaskController::class, "showCreateTask"])->name('teacher.create_task');
    Route::post("store_task", [TeacherTaskController::class, "createTask"])->name("teacher.task_store");
});


//Shared URL

Route::middleware(['auth'])->group( function() {
    Route::get('/dashboard', [RouteController::class, 'dashboardCaller'])->name('dashboard');
    Route::get('/assignment', [RouteController::class, 'assignmentCaller'])->name('assignment');
});

require __DIR__.'/auth.php';