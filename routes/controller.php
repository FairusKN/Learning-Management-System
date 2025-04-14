<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group( function () {
    Route::get('/dashboard', [TaskController::class, 'indexStudent'])
        ->name('dashboard');
})

?>