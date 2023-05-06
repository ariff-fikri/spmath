<?php

use App\Http\Controllers\ChapterController;
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

// Chapter
Route::get('/chapter', [ChapterController::class, 'index'])->name('chapter.index');
Route::get('/chapter/create', [ChapterController::class, 'create'])->name('chapter.create');
Route::post('/chapter/store', [ChapterController::class, 'store'])->name('chapter.store');
Route::get('/chapter/edit/{chapter}', [ChapterController::class, 'edit'])->name('chapter.edit');
Route::post('/chapter/edit/file/{chapter}', [ChapterController::class, 'file'])->name('chapter.file');
Route::get('/chapter/read/file/{chapter}', [ChapterController::class, 'read_files'])->name('chapter.read_files');
Route::post('/chapter/remove/file/{chapter}', [ChapterController::class, 'remove_files'])->name('chapter.remove_files');
Route::post('/chapter/update/{chapter}', [ChapterController::class, 'update'])->name('chapter.update');
Route::get('/chapter/show/{chapter}', [ChapterController::class, 'show'])->name('chapter.show');
Route::get('/chapter/preview/{chapter}', [ChapterController::class, 'preview'])->name('chapter.preview');
Route::get('/chapter/download/{chapter}', [ChapterController::class, 'download'])->name('chapter.download');

// Past Year
Route::get('/past-year', [PastYearController::class, 'index'])->name('past-year.index');

// Quiz
Route::get('/quiz/index', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/show', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
Route::post('/quiz/update/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
Route::post('/quiz/update/question/{quiz_question}', [QuizController::class, 'update_question'])->name('quiz.update.question');
Route::post('/quiz/question/store', [QuizController::class, 'question_store'])->name('quiz.question.store');
Route::get('/quiz/create-after-submit/{quiz}', [QuizController::class, 'create_after_submit'])->name('quiz.create-after-submit');
Route::get('/quiz/edit/{quiz}', [QuizController::class, 'edit'])->name('quiz.edit');
Route::get('/quiz/edit/question/{quiz_question}', [QuizController::class, 'edit_question'])->name('quiz.edit.question');

