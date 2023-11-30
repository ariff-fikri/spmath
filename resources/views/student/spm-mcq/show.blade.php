@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Manage SPM MCQ</h1>
            <div>
                @if (auth()->user())
                    <a href="{{ route('spm_mcq.create') }}" class="btn btn-info">
                        Create SPM MCQ
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
            <a href="#form_4" class="active" data-toggle="tab" role="tab" aria-controls="form_4" aria-selected="true">All</a>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active show fade" id="form_4">
                <div class="row">
                    @forelse ($quizzes as $quiz)
                        <div class="col-md-3">
                            <div class="card card__course">
                                <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                    <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="{{ route('spm_mcq.edit', $quiz->id) }}">
                                        <span class="course__subtitle">{{ $quiz->title ?? '' }}</span>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <div class="d-flex align-items-center">
                                        @if (auth()->user())
                                            <a href="{{ route('spm_mcq.edit', $quiz->id) }}" class="btn btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('spm_mcq.remove', $quiz->id) }}" onclick="event.preventDefault(); document.getElementById('remove-quiz-form-{{ $quiz->id }}').submit();" class="btn btn-danger ml-2">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="remove-quiz-form-{{ $quiz->id }}" action="{{ route('spm_mcq.remove', $quiz->id) }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        @endif
                                        <a href="{{ route('spm_mcq.index', $quiz->id) }}" class="btn btn-primary ml-auto">Go to Quiz <i class="fa fa-arrow-right"></i></a>
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
