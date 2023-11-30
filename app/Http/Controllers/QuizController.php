<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Chapter $chapter)
    {
        $quiz = Quiz::where('chapter_id', $chapter->id)->with(['quiz_questions'])->first();

        return view('student.quiz.index', compact('quiz'));
    }

    public function spm_mcq()
    {
        $quiz_questions = QuizQuestion::inRandomOrder()->limit(15)->get();

        return view('student.quiz.mcq', compact('quiz_questions'));
    }

    public function create()
    {
        $chapters = Chapter::all();

        return view('student.quiz.create', compact('chapters'));
    }

    public function store(Request $request)
    {
        $quiz_check = Quiz::where('chapter_id', $request->chapter_id)->first();

        if ($quiz_check) {

            return back()->with('error', 'Quiz for this chapter has already been submitted. Please try another chapter.');
        }

        $quiz = Quiz::create($request->all());

        return redirect()->route('quiz.create-after-submit', $quiz->id)->with('success', 'Quiz has been stored. Please then enter your questions.');
    }

    public function submit_answer(Request $request, Quiz $quiz)
    {
        $request->session()->remove('quiz');
        $request->session()->remove('total_correct_answer');
        $request->session()->remove('total_questions');

        $total_correct_answer = 0;
        $total_questions = 0;

        foreach ($request->question as $key => $question) {
            $quiz_question = QuizQuestion::where('id', $key)->first();

            $request->session()->put('quiz.question_'.$key, (object) ([
                'input_answer' => $question,
                'input_answer_label' => $quiz_question->answer_label($question, $quiz_question->id),
                'title' => $quiz_question->title,
                'correct_answer' => $quiz_question->correct_answer,
                'correct_answer_label' => $quiz_question->answer_label($question, $quiz_question->id),
                'status' => ($question == $quiz_question->correct_answer ? true : false),
            ]));

            if ($question == $quiz_question->correct_answer) {

                $total_correct_answer++;
            }

            $total_questions++;
        }

        $request->session()->put('total_correct_answer', $total_correct_answer);
        $request->session()->put('total_questions', $total_questions);

        $quiz_result = (object) ($request->session()->all());

        // dd($quiz_result);

        return view('student.quiz.result', compact('quiz', 'quiz_result'));
    }

    public function submit_answer_mcq(Request $request)
    {
        $request->session()->remove('quiz');
        $request->session()->remove('total_correct_answer');
        $request->session()->remove('total_questions');
        $request->session()->remove('time');

        $total_correct_answer = 0;
        $total_questions = 0;

        foreach ($request->question as $key => $question) {
            $quiz_question = QuizQuestion::where('id', $key)->first();

            $request->session()->put('quiz.question_'.$key, (object) ([
                'input_answer' => $question,
                'input_answer_label' => $quiz_question->answer_label($question, $quiz_question->id),
                'title' => $quiz_question->title,
                'correct_answer' => $quiz_question->correct_answer,
                'correct_answer_label' => $quiz_question->answer_label($question, $quiz_question->id),
                'status' => ($question == $quiz_question->correct_answer ? true : false),
            ]));

            if ($question == $quiz_question->correct_answer) {

                $total_correct_answer++;
            }

            $total_questions++;
        }

        $request->session()->put('total_correct_answer', $total_correct_answer);
        $request->session()->put('total_questions', $total_questions);
        $request->session()->put('time', $request->time);

        $quiz_result = (object) ($request->session()->all());

        // dd($quiz_result);

        return view('student.quiz.result', compact('quiz_result'));
    }

    public function edit(Request $request, $quiz)
    {
        $quiz = Quiz::where('id', $quiz)->with('quiz_questions')->first();

        $chapters = Chapter::all();

        return view('student.quiz.edit', compact('quiz', 'chapters'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $quiz_check = Quiz::where('chapter_id', $request->chapter_id)->whereNotIn('id', [$quiz->id])->first();

        if ($quiz_check) {

            return back()->with('error', 'Quiz for this chapter has already been submitted. Please try another chapter.');
        }

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

    public function remove(Request $request, Quiz $quiz)
    {
        $quiz->delete();

        return back()->with('success', 'Quiz has been deleted.');
    }
}
