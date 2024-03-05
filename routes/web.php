<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::middleware('admin-only')->group(function () {
        Route::get('/', [AdminController::class, 'home'])->name('admin-dashboard');;
    });
    Route::middleware('teacher-only')->group(function () {
        Route::prefix('teacher')->group(function () {
            Route::get('/', [TeacherController::class, 'home'])->name('teacher-dashboard');;
        });
    });
    Route::middleware('student-only')->group(function () {
        Route::prefix('student')->group(function () {
            Route::get('/', [StudentController::class, 'home'])->name('student-dashboard');;
        });
    });
    Route::get('/logout', [AuthController::class, 'signout']);
});

// Account Login
Route::middleware('guest')->group(function () {
    Route::get('/signin', [AuthController::class, 'signin'])->name('login');
    Route::get('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'authentication']);
    Route::post('/signup', [AuthController::class, 'store']);
});
