<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return view('student.quiz.index');
    }

    public function create()
    {
        $chapters = Chapter::all();

        return view('student.quiz.create', compact('chapters'));
    }

    public function store(Request $request)
    {
        $quiz = Quiz::create($request->all());

        return redirect()->route('quiz.create-after-submit', $quiz->id)->with('success', 'Quiz has been stored. Please then enter your questions.');
    }

    public function edit(Request $request, $quiz)
    {
        $quiz = Quiz::where('id', $quiz)->with('quiz_questions')->first();

        $chapters = Chapter::all();

        return view('student.quiz.edit', compact('quiz', 'chapters'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $quiz = $quiz->update($request->all());

        return back()->with('success', 'Quiz has been updated.');
    }

    public function update_question(Request $request, QuizQuestion $quiz_question)
    {
        $quiz_question = $quiz_question->update($request->all());

        return back()->with('success', 'Quiz Question has been updated.');
    }


    public function edit_question(Request $request, QuizQuestion $quiz_question)
    {
        $chapters = Chapter::all();

        return view('student.quiz.edit-question', compact('quiz_question', 'chapters'));
    }

    public function show()
    {
        $quizzes = Quiz::all();

        return view('student.quiz.show', compact('quizzes'));
    }

    public function create_after_submit(Request $request, $quiz)
    {
        $quiz = Quiz::where('id', $quiz)->with('quiz_questions')->first();

        return view('student.quiz.create-question-after-submit', compact('quiz'));
    }

    public function question_store(Request $request)
    {
        $quiz_question = QuizQuestion::create($request->all());

        return back()->with('success', 'Quiz Question has been stored.');
    }
}
