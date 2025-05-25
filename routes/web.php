<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\student\StudentTaskController;
use App\Http\Controllers\teacher\GradingController;
use App\Http\Controllers\teacher\TeacherTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("landing_page");
});

Route::get('/login', function() {
    return view('auth.login');
});

// Role Based URL
// Student
Route::middleware(['auth', 'role:student'])->group( function () {

    Route::get('/submission/{task:slug}', [StudentTaskController::class, 'taskSubmission'])
        ->name('student.tasksubmission');

    Route::post("/tasksubmission-upload/{task:slug}", [StudentTaskController::class, 'taskSubmissionUpload'])
        ->name("student.tasksubmission.upload");

    Route::get('/grade-receipt', [PDFController::class, 'showGradeReceipt'])->name('receipt.preview');
    Route::get('/grade-receipt/pdf', [PDFController::class, 'downloadGradeReceiptPdf'])->name('receipt.pdf');
});


// Teacher
Route::middleware(['auth', 'role:teacher'])->group( function () {
    Route::get('/create_task', [TeacherTaskController::class, "showCreateTask"])->name('teacher.create_task');
    Route::post("store_task", [TeacherTaskController::class, "createTask"])->name("teacher.task_store");

    Route::get('/grade_task/{task:slug}', [GradingController::class, "grading"])->name("teacher.class_to_grade");

    Route::get('/grade_task/{task:slug}/{submission:id}', [GradingController::class, "grade"])->name("teacher.grading");

    Route::post('/submit_grade/{submission:id}', [GradingController::class, 'submit_grade'])->name("teacher.submit_grade");
});


//Shared URL

Route::middleware(['auth'])->group( function() {
    Route::get('/dashboard', [RouteController::class, 'dashboardCaller'])->name('dashboard');
    Route::get('/assignment', [RouteController::class, 'assignmentCaller'])->name('assignment');
});

require __DIR__.'/auth.php';