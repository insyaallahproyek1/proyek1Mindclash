<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
# App\Http\Controllers\CategoryController;
=======
//use App\Http\Controllers\CategoryController;
>>>>>>> 83808ca220fd0c68de8060f210442b509ca91693
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
#Route::resource('categories', CategoryController::class);
=======
//Route::resource('categories', CategoryController::class);
>>>>>>> 83808ca220fd0c68de8060f210442b509ca91693
Route::resource('questions', QuestionController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);

// ======================
// LOGIN
// ======================

Route::get('/login',
[AuthController::class, 'showLogin']);

Route::post('/login',
[AuthController::class, 'login']);


// ======================
// REGISTER
// ======================

Route::get('/register',
[AuthController::class, 'showRegister']);

Route::post('/register',
[AuthController::class, 'register']);


// ======================
// LOGOUT
// ======================

Route::get('/logout',
[AuthController::class, 'logout']);
