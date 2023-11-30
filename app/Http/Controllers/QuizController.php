<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuizController extends Controller
{
    /**
     * Display the quiz index page for a specific chapter.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Chapter $chapter): RedirectResponse
    {
        try {
            $quiz = Quiz::where('chapter_id', $chapter->id)->with('quizQuestions')->firstOrFail();

            return view('student.quiz.index', compact('quiz'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'No quiz found for this chapter.');
        }
    }

    /**
     * Display the multiple-choice quiz page with random questions.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function spm_mcq(): View
    {
        $quizQuestions = QuizQuestion::inRandomOrder()->limit(15)->get();

        return view('student.quiz.mcq', compact('quizQuestions'));
    }

    /**
     * Display the quiz creation form with a list of available chapters.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        // Fetch all available chapters
        $chapters = Chapter::all();

        return view('student.quiz.create', compact('chapters'));
    }

    /**
     * Store a new quiz and redirect to the quiz creation page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $quizCheck = Quiz::where('chapter_id', $request->chapter_id)->first();

        if ($quizCheck) {
            return back()->with('error', 'Quiz for this chapter has already been submitted. Please try another chapter.');
        }

        $quiz = Quiz::create($request->all());

        return redirect()->route('quiz.create-after-submit', $quiz->id)->with('success', 'Quiz has been stored. Please then enter your questions.');
    }

    /**
     * Submit quiz answers, calculate results, and display the result page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Contracts\View\View
     */
    public function submit_answer(Request $request, Quiz $quiz): View
    {
        $request->session()->remove('quiz');
        $request->session()->remove('total_correct_answer');
        $request->session()->remove('total_questions');

        $total_correct_answer = 0;
        $total_questions = 0;

        foreach ($request->question as $key => $question) {
            $quizQuestion = QuizQuestion::where('id', $key)->first();

            $request->session()->put('quiz.question_' . $key, (object) [
                'input_answer' => $question,
                'input_answer_label' => $quizQuestion->answer_label($question, $quizQuestion->id),
                'title' => $quizQuestion->title,
                'correct_answer' => $quizQuestion->correct_answer,
                'correct_answer_label' => $quizQuestion->answer_label($question, $quizQuestion->id),
                'status' => ($question == $quizQuestion->correct_answer),
            ]);

            if ($question == $quizQuestion->correct_answer) {
                $total_correct_answer++;
            }

            $total_questions++;
        }

        $request->session()->put('total_correct_answer', $total_correct_answer);
        $request->session()->put('total_questions', $total_questions);

        $quizResult = (object) $request->session()->all();

        return view('student.quiz.result', compact('quiz', 'quizResult'));
    }

    /**
     * Submit multiple-choice quiz answers, calculate results, and display the result page.
     *
     * @param  \Illuminate\Http\Request  $request
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

        foreach ($request->question as $key => $question) {
            $quizQuestion = QuizQuestion::where('id', $key)->first();

            $request->session()->put('quiz.question_' . $key, (object) [
                'input_answer' => $question,
                'input_answer_label' => $quizQuestion->answer_label($question, $quizQuestion->id),
                'title' => $quizQuestion->title,
                'correct_answer' => $quizQuestion->correct_answer,
                'correct_answer_label' => $quizQuestion->answer_label($question, $quizQuestion->id),
                'status' => ($question == $quizQuestion->correct_answer),
            ]);

            if ($question == $quizQuestion->correct_answer) {
                $total_correct_answer++;
            }

            $total_questions++;
        }

        $request->session()->put('total_correct_answer', $total_correct_answer);
        $request->session()->put('total_questions', $total_questions);
        $request->session()->put('time', $request->time);

        $quizResult = (object) $request->session()->all();

        return view('student.quiz.result', compact('quizResult'));
    }

    /**
     * Display the quiz edit form with quiz details and a list of available chapters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $quiz
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $quiz): View
    {
        $quiz = Quiz::where('id', $quiz)->with('quizQuestions')->first();

        $chapters = Chapter::all();

        return view('student.quiz.edit', compact('quiz', 'chapters'));
    }

    /**
     * Update the quiz details and redirect back with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Quiz $quiz): RedirectResponse
    {
        $quizCheck = Quiz::where('chapter_id', $request->chapter_id)->whereNotIn('id', [$quiz->id])->first();

        if ($quizCheck) {
            return back()->with('error', 'Quiz for this chapter has already been submitted. Please try another chapter.');
        }

        $quiz->update($request->all());

        return back()->with('success', 'Quiz has been updated.');
    }

    /**
     * Update the details of a quiz question and redirect back with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestion  $quiz_question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_question(Request $request, QuizQuestion $quiz_question): RedirectResponse
    {
        $quiz_question->update($request->all());

        return back()->with('success', 'Quiz Question has been updated.');
    }

    /**
     * Display the quiz question edit form with question details and a list of available chapters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestion  $quiz_question
     * @return \Illuminate\Contracts\View\View
     */
    public function edit_question(Request $request, QuizQuestion $quiz_question): View
    {
        $chapters = Chapter::all();

        return view('student.quiz.edit-question', compact('quiz_question', 'chapters'));
    }

    /**
     * Display a list of all quizzes.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): View
    {
        $quizzes = Quiz::all();

        return view('student.quiz.show', compact('quizzes'));
    }

    /**
     * Display the quiz question creation form after submitting the quiz.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $quiz
     * @return \Illuminate\Contracts\View\View
     */
    public function create_after_submit(Request $request, $quiz): View
    {
        $quiz = Quiz::where('id', $quiz)->with('quizQuestions')->first();

        return view('student.quiz.create-question-after-submit', compact('quiz'));
    }

    /**
     * Store a new quiz question and redirect back with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function question_store(Request $request): RedirectResponse
    {
        $quiz_question = QuizQuestion::create($request->all());

        return back()->with('success', 'Quiz Question has been stored.');
    }

    /**
     * Remove a quiz and redirect back with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request, Quiz $quiz): RedirectResponse
    {
        $quiz->delete();

        return back()->with('success', 'Quiz has been deleted.');
    }
}
