<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    // Jika user belum login, redirect ke halaman login
    if (!auth()->check()) {
        return redirect('/login');
    }
    
    // Jika sudah login, cek role
    if (auth()->user()->role === 'admin') {
        return redirect('/dashboard');
    }
    
    return redirect('/quiz-home');
});

// Admin Routes - Proteksi dengan middleware
Route::middleware('auth')->group(function () {
    Route::resource('questions', QuestionController::class);
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

// User Quiz Routes - Proteksi dengan middleware
Route::middleware('auth')->group(function () {
    Route::get('/quiz-home', [UserController::class, 'home']);
    Route::get('/quiz/{categoryId}', [UserController::class, 'showQuiz']);
    Route::post('/quiz/submit', [UserController::class, 'submitQuiz']);
    Route::get('/leaderboard', [UserController::class, 'leaderboard']);
});

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
