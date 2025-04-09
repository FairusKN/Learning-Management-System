<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', [TaskController::class, 'index'])->name('task.index'); 
// Route::get('/dashboard', [TaskController::class, 'show'])->name('task.show');

Route::get('/dashboard', [TaskController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

?>