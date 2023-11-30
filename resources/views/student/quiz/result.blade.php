
@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h1 class="m-lg-0">Quiz Result</h1>
                <div class="d-inline-flex align-items-center">
                    <i class="material-icons icon-16pt mr-1 text-muted">school</i> <a href="#" class="text-muted">{{ isset($quiz) ? $quiz->title : 'SPM MCQ' }}</a>
                </div>
            <p class="text-muted"><i class="fa fa-check text-muted"></i> Submitted on {{ now()->toFormattedDateString() }}</p>

            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid page__container">
    <div class="media mb-headings align-items-center">
        <div class="media-body">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Result</h4>
        </div>
        <div class="card-body media align-items-center">
            <div class="media-body">
                <h4 class="mb-0">{{ number_format((float)($quiz_result->total_correct_answer / $quiz_result->total_questions * 10), 1, '.', '') }}</h4>
                <span class="text-{{ (number_format((float)($quiz_result->total_correct_answer / $quiz_result->total_questions * 10), 1, '.', '')) > 5.0 ? 'success' : 'danger' }}">{{ (number_format((float)($quiz_result->total_correct_answer / $quiz_result->total_questions * 10), 1, '.', '')) > 5.0 ? 'Good' : 'Bad' }}</span>
                <br>
                <br>
                <span class="text-muted">
                    You score {{ $quiz_result->total_correct_answer }} / {{ $quiz_result->total_questions }} questions.
                </span>
                <br>
                @if (isset($quiz_result->time))
                    <span class="text-muted">
                        Your time : {{ date('i:s', $quiz_result->time / 1000) }}
                    </span>
                @endif
            </div>
            <div class="media-right">
                
                <a href="{{ isset($quiz) ? route('quiz.index', $quiz->chapter_id) : route('spm_mcq.index', $quiz->id) }}" class="btn btn-primary">Restart <i class="material-icons btn__icon--right">refresh</i></a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Questions</h4>
        </div>
        <ul class="list-group list-group-fit mb-0">
            @foreach ($quiz_result->quiz as $key => $quiz_question)
                <li class="list-group-item">
                    <div class="media">
                        <div class="media-left">
                            <div class="text-muted-light">{{ $loop->iteration }}.</div>
                        </div>
                        <div class="media-body row">
                            <div class="col-md-8">
                                {!! $quiz_question->title !!}
                            </div>
                            <div class="col-md-4">
                                <span>
                                    Your Answer : <span class="text-right">{{ strtoupper($quiz_question->input_answer) }}</span>
                                </span> <br>
                                <span>
                                    Correct Answer : <span class="text-right">{{ strtoupper($quiz_question->correct_answer) }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="media-right">
                            <span class="badge badge-{{ $quiz_question->status ? 'success' : 'danger' }}">
                                {{ $quiz_question->status ? 'Correct' : 'Wrong' }}
                            </span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection