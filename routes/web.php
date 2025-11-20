<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\ProjectController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::fallback(function () {
    return view('error.404NotFound');
});

Route::get('/', function () {
    return view('pages.main.profile');
});