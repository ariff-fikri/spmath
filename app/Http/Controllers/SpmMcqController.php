<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\SpmMcq;
use App\Models\SpmMcqQuestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpmMcqController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpmMcq  $spmMcq
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SpmMcq $spmMcq): View
    {
        $spmMcq = SpmMcq::where('id', $spmMcq->id)->with('quizQuestions')->first();

        return view('student.spm-mcq.index', compact('spmMcq'));
    }

    /**
     * Display a set of randomly selected SpmMcq questions for a multiple-choice quiz.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function spm_mcq(): View
    {
        $quiz_questions = SpmMcqQuestion::inRandomOrder()->limit(15)->get();

        return view('student.spm-mcq.mcq', compact('quiz_questions'));
    }

    /**
     * Display the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $chapters = Chapter::all();

        return view('student.spm-mcq.create', ['chapters' => $chapters]);
    }

    /**
     * Store a new SpmMcq and redirect to the quiz creation page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('spm_mcqs', 'title'),
            ],
        ]);

        $quiz = SpmMcq::firstOrCreate(['title' => $request->title], $request->except('title'));

        return redirect()->route('spm_mcq.create-after-submit', $quiz->id)->with('success', 'Quiz has been stored. Please then enter your questions.');
    }

    /**
     * Process submitted answers for the specified SpmMcq.
     *
     * @param  Request  $request
     * @param  SpmMcq  $spm_mcq
     * @return \Illuminate\Contracts\View\View
     */
    public function submit_answer(Request $request, SpmMcq $spm_mcq): View
    {
        $request->validate([
            'question.*' => 'required', // Add more validation rules as needed
        ]);

        $questions = $spm_mcq->questions;

        $quizResult = [
            'totalCorrectAnswer' => 0,
            'totalQuestions' => $questions->count(),
            'questions' => [],
        ];

        foreach ($questions as $question) {
            $userAnswer = $request->question[$question->id];
            $isCorrect = $userAnswer == $question->correct_answer;

            $quizResult['questions'][] = [
                'inputAnswer' => $userAnswer,
                'inputAnswerLabel' => $question->answer_label($userAnswer, $question->id),
                'title' => $question->title,
                'correctAnswer' => $question->correct_answer,
                'correctAnswerLabel' => $question->answer_label($question->correct_answer, $question->id),
                'status' => $isCorrect,
            ];

            if ($isCorrect) {
                $quizResult['totalCorrectAnswer']++;
            }
        }

        return view('student.spm-mcq.result', compact('spm_mcq', 'quizResult'));
    }

    /**
     * Process submitted answers for multiple-choice questions.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function submit_answer_mcq(Request $request): View
    {
        $request->session()->remove('quiz');
        $request->session()->remove('total_correct_answer');
        $request->session()->remove('total_questions');
        $request->session()->remove('time');

        $total_correct_answer = 0;
        $total_questions = 0;

        foreach ($request->question as $key => $userAnswer) {
            $quiz_question = SpmMcqQuestion::findOrFail($key);

            $request->session()->put('quiz.question_' . $key, (object) [
                'input_answer' => $userAnswer,
                'input_answer_label' => $quiz_question->answer_label($userAnswer, $quiz_question->id),
                'title' => $quiz_question->title,
                'correct_answer' => $quiz_question->correct_answer,
                'correct_answer_label' => $quiz_question->answer_label($userAnswer, $quiz_question->id),
                'status' => ($userAnswer == $quiz_question->correct_answer),
            ]);

            if ($userAnswer == $quiz_question->correct_answer) {
                $total_correct_answer++;
            }

            $total_questions++;
        }

        $request->session()->put('total_correct_answer', $total_correct_answer);
        $request->session()->put('total_questions', $total_questions);
        $request->session()->put('time', $request->time);

        $quiz_result = (object) $request->session()->all();

        return view('student.spm-mcq.result', compact('quiz_result'));
    }

    /**
     * Display the form for editing the specified quiz.
     *
     * @param  Request  $request
     * @param  int  $quiz
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $quiz): View
    {
        $quiz = SpmMcq::where('id', $quiz)->with('quiz_questions')->firstOrFail();

        return view('student.spm-mcq.edit', compact('quiz'));
    }

    /**
     * Update the specified quiz in storage.
     *
     * @param  Request  $request
     * @param  SpmMcq  $spm_mcq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SpmMcq $spm_mcq): RedirectResponse
    {
        $spm_mcq->update($request->all());

        return redirect()->back()->with('success', 'Quiz has been updated.');
    }

    /**
     * Update the specified quiz question in storage.
     *
     * @param  Request  $request
     * @param  SpmMcqQuestion  $spm_mcq_question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_question(Request $request, SpmMcqQuestion $spm_mcq_question): RedirectResponse
    {
        $spm_mcq_question->update($request->all());

        return redirect()->back()->with('success', 'Quiz Question has been updated.');
    }

    /**
     * Display the form for editing the specified quiz question.
     *
     * @param  Request  $request
     * @param  SpmMcqQuestion  $spm_mcq_question
     * @return \Illuminate\View\View
     */
    public function edit_question(Request $request, SpmMcqQuestion $spm_mcq_question): View
    {
        return view('student.spm-mcq.edit-question', compact('spm_mcq_question'));
    }

    /**
     * Display a listing of quizzes.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        $quizzes = SpmMcq::all();

        return view('student.spm-mcq.show', compact('quizzes'));
    }

    /**
     * Display the form for creating questions after submitting a quiz.
     *
     * @param  Request  $request
     * @param  int  $quiz
     * @return View
     */
    public function create_after_submit(Request $request, int $quiz): View
    {
        $quiz = SpmMcq::where('id', $quiz)->with('quiz_questions')->first();

        return view('student.spm-mcq.create-question-after-submit', compact('quiz'));
    }

    /**
     * Store a newly created quiz question in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function question_store(Request $request): RedirectResponse
    {
        SpmMcqQuestion::create($request->all());

        return back()->with('success', 'Quiz Question has been stored.');
    }

    /**
     * Remove the specified SPM MCQ from storage.
     *
     * @param  Request  $request
     * @param  SpmMcq  $spm_mcq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request, SpmMcq $spm_mcq): RedirectResponse
    {
        $spm_mcq->delete();

        return back()->with('success', 'SPM MCQ has been deleted.');
    }
}
