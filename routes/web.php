<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PastYearController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Course
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
Route::get('/course/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::get('/course/show', [CourseController::class, 'show'])->name('course.show');

// Past Year
Route::get('/past-year', [PastYearController::class, 'index'])->name('past-year.index');

// Quiz
Route::get('/quiz/index', [QuizController::class, 'index'])->name('quiz.index');

