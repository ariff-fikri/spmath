<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\SpmMcq;
use App\Models\SpmMcqQuestion;
use Illuminate\Http\Request;

class SpmMcqController extends Controller
{
    public function index(SpmMcq $spm_mcq)
    {
        $spm_mcq = SpmMcq::where('id', $spm_mcq->id)->with('quiz_questions')->first();

        return view('student.spm-mcq.index', compact('spm_mcq'));
    }

    public function spm_mcq()
    {
        $quiz_questions = SpmMcqQuestion::inRandomOrder()->limit(15)->get();

        return view('student.spm-mcq.mcq', compact('quiz_questions'));
    }

    public function create()
    {
        $chapters = Chapter::all();

        return view('student.spm-mcq.create', compact('chapters'));
    }

    public function store(Request $request)
    {
        $quiz_check = SpmMcq::where('title', $request->title)->first();

        if ($quiz_check) {

            return back()->with('error', 'Quiz for this chapter has already been submitted. Please try another chapter.');
        }

        $quiz = SpmMcq::create($request->all());

        return redirect()->route('spm_mcq.create-after-submit', $quiz->id)->with('success', 'Quiz has been stored. Please then enter your questions.');
    }

    public function submit_answer(Request $request, SpmMcq $spm_mcq)
    {
        $request->session()->remove('spm_mcq');
        $request->session()->remove('total_correct_answer');
        $request->session()->remove('total_questions');

        $total_correct_answer = 0;
        $total_questions = 0;

        foreach ($request->question as $key => $question) {
            $quiz_question = SpmMcqQuestion::where('id', $key)->first();

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

        return view('student.spm-mcq.result', compact('spm_mcq', 'quiz_result'));
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
            $quiz_question = SpmMcqQuestion::where('id', $key)->first();

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

        return view('student.spm-mcq.result', compact('quiz_result'));
    }

    public function edit(Request $request, $quiz)
    {
        $quiz = SpmMcq::where('id', $quiz)->with('quiz_questions')->first();

        return view('student.spm-mcq.edit', compact('quiz'));
    }

    public function update(Request $request, SpmMcq $spm_mcq)
    {
        $spm_mcq = $spm_mcq->update($request->all());

        return back()->with('success', 'Quiz has been updated.');
    }

    public function update_question(Request $request, SpmMcqQuestion $spm_mcq_question)
    {
        $spm_mcq_question = $spm_mcq_question->update($request->all());

        return back()->with('success', 'Quiz Question has been updated.');
    }

    public function edit_question(Request $request, SpmMcqQuestion $spm_mcq_question)
    {
        return view('student.spm-mcq.edit-question', compact('spm_mcq_question'));
    }

    public function show()
    {
        $quizzes = SpmMcq::all();

        return view('student.spm-mcq.show', compact('quizzes'));
    }

    public function create_after_submit(Request $request, $quiz)
    {
        $quiz = SpmMcq::where('id', $quiz)->with('quiz_questions')->first();

        return view('student.spm-mcq.create-question-after-submit', compact('quiz'));
    }

    public function question_store(Request $request)
    {
        $quiz_question = SpmMcqQuestion::create($request->all());

        return back()->with('success', 'Quiz Question has been stored.');
    }

    public function remove(Request $request, SpmMcq $spm_mcq)
    {
        $spm_mcq->delete();

        return back()->with('success', 'SPM MCQ has been deleted.');
    }
}
