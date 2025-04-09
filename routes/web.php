<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("landing_page");
});

Route::get('/login', function() {
    return view('auth.login');
});


require __DIR__.'/auth.php';
require __DIR__.'/controller.php';
