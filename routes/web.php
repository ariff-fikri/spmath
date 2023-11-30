<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PastYearController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SpmMcqController;
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
Route::post('/chapter/remove/{chapter}', [ChapterController::class, 'remove'])->name('chapter.remove');

// Past Year
Route::get('/past-year', [PastYearController::class, 'index'])->name('past-year.index');
Route::get('/past-year/create', [PastYearController::class, 'create'])->name('past-year.create');
Route::post('/past-year/store', [PastYearController::class, 'store'])->name('past-year.store');
Route::post('/past-year/remove/{past_year}', [PastYearController::class, 'remove'])->name('past-year.remove');

// Quiz
Route::get('/quiz/index/{chapter}', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/spm_mcq', [QuizController::class, 'spm_mcq'])->name('quiz.spm_mcq');
Route::get('/quiz/show', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
Route::post('/quiz/update/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
Route::post('/quiz/submit_answer/{quiz}', [QuizController::class, 'submit_answer'])->name('quiz.submit_answer');
Route::post('/quiz/submit_answer_mcq', [QuizController::class, 'submit_answer_mcq'])->name('quiz.submit_answer_mcq');
Route::post('/quiz/update/question/{quiz_question}', [QuizController::class, 'update_question'])->name('quiz.update.question');
Route::post('/quiz/question/store', [QuizController::class, 'question_store'])->name('quiz.question.store');
Route::get('/quiz/create-after-submit/{quiz}', [QuizController::class, 'create_after_submit'])->name('quiz.create-after-submit');
Route::get('/quiz/edit/{quiz}', [QuizController::class, 'edit'])->name('quiz.edit');
Route::get('/quiz/edit/question/{quiz_question}', [QuizController::class, 'edit_question'])->name('quiz.edit.question');
Route::post('/quiz/remove/{quiz}', [QuizController::class, 'remove'])->name('quiz.remove');

// SPM MCQ
Route::get('/spm_mcq/index/{spm_mcq}', [SpmMcqController::class, 'index'])->name('spm_mcq.index');
Route::get('/spm_mcq/show', [SpmMcqController::class, 'show'])->name('spm_mcq.show');
Route::get('/spm_mcq/create', [SpmMcqController::class, 'create'])->name('spm_mcq.create');
Route::post('/spm_mcq/store', [SpmMcqController::class, 'store'])->name('spm_mcq.store');
Route::post('/spm_mcq/update/{spm_mcq}', [SpmMcqController::class, 'update'])->name('spm_mcq.update');
Route::post('/spm_mcq/submit_answer/{spm_mcq}', [SpmMcqController::class, 'submit_answer'])->name('spm_mcq.submit_answer');
Route::post('/spm_mcq/submit_answer_mcq', [SpmMcqController::class, 'submit_answer_mcq'])->name('spm_mcq.submit_answer_mcq');
Route::post('/spm_mcq/update/question/{spm_mcq_question}', [SpmMcqController::class, 'update_question'])->name('spm_mcq.update.question');
Route::post('/spm_mcq/question/store', [SpmMcqController::class, 'question_store'])->name('spm_mcq.question.store');
Route::get('/spm_mcq/create-after-submit/{spm_mcq}', [SpmMcqController::class, 'create_after_submit'])->name('spm_mcq.create-after-submit');
Route::get('/spm_mcq/edit/{spm_mcq}', [SpmMcqController::class, 'edit'])->name('spm_mcq.edit');
Route::get('/spm_mcq/edit/question/{spm_mcq_question}', [SpmMcqController::class, 'edit_question'])->name('spm_mcq.edit.question');
Route::post('/spm_mcq/remove/{spm_mcq}', [SpmMcqController::class, 'remove'])->name('spm_mcq.remove');
