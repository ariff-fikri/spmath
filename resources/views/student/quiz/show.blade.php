@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Manage Quizzes</h1>
            <div>
                @if (auth()->user())
                    <a href="{{ route('quiz.create') }}" class="btn btn-info">
                        Create Quiz
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        @if (Session::has('success'))
            <div class="alert alert-soft-success d-flex" role="alert">
                <i class="fa fa-check mr-3"></i>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-soft-danger d-flex" role="alert">
                <i class="fa fa-times mr-3"></i>
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @endif

        <div class="card-header card-header-tabs-basic nav" role="tablist">
            <a href="#form_4" class="active" data-toggle="tab" role="tab" aria-controls="form_4" aria-selected="true">Form 4</a>
            <a href="#form_5" data-toggle="tab" role="tab" aria-controls="form_5" aria-selected="false">Form 5</a>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active show fade" id="form_4">
                <div class="row">
                    @forelse ($quizzes->where('student_year_id', 4) as $quiz_form_4)
                        <div class="col-md-3">
                            <div class="card card__course">
                                <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                    <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="{{ route('quiz.edit', $quiz_form_4->id) }}">
                                        <span class="course__title">Chapter {{ $quiz_form_4->chapter_id ?? '' }}</span>
                                        <span class="course__subtitle">{{ $quiz_form_4->title ?? '' }}</span>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <div class="d-flex align-items-center">
                                        @if (auth()->user())
                                            <a href="{{ route('quiz.edit', $quiz_form_4->id) }}" class="btn btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('quiz.index', $quiz_form_4->chapter_id) }}" class="btn btn-primary ml-auto">Go to Quiz <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No quizzes
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="form_5">
                <div class="row">
                    @forelse ($quizzes->where('student_year_id', 5) as $quiz_form_5)
                        <div class="col-md-3">
                            <div class="card card__course">
                                <div
                                    class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                    <a class="card-header__title  justify-content-center align-self-center d-flex flex-column"
                                        href="{{ route('quiz.edit', $quiz_form_4->id) }}">
                                        <span class="course__title">Chapter {{ $quiz_form_5->chapter_id ?? '' }}</span>
                                        <span class="course__subtitle">{{ $quiz_form_5->title ?? '' }}</span>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <div class="d-flex align-items-center">
                                        @if (auth()->user())
                                            <a href="{{ route('quiz.edit', $quiz_form_5->id) }}" class="btn btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('quiz.index', $quiz_form_5->chapter_id) }}" class="btn btn-primary ml-auto">Go to Quiz <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No quizzes
                    @endforelse
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
