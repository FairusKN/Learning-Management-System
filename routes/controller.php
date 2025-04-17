<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified', 'role:student'])->group( function () {
    Route::get('/dashboard', [TaskController::class, 'indexStudent'])
        ->name('dashboard');
    Route::get('/submission/{task_id}', [TaskController::class, 'taskSubmission'])
        ->name('tasksubmission');
    Route::post("/tasksubmissionupload/{task_id}", [TaskController::class, 'taskSubmissionUpload'])
        ->name("tasksubmission.upload");


    Route::get('/assignment', [TaskController::class, 'showTask'])
        ->name("assignmentStudent");
});

Route::middleware(['auth', 'verified', 'role:teacher'])->group( function () {
    Route::get('/dashboard', [TaskController::class, ''])
        ->name('dashboard');
});
?>