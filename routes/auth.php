<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])
        ->middleware('auth')->name('logout');

     Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
         ->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    
});
