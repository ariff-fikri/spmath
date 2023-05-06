@extends('layout.app')

@push('styles')
    <!-- Vendor CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/nestable.css') }}"> --}}
@endpush

@section('header')
    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h1 class="m-lg-0">Create Quiz</h1>
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Quiz Details</h4>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quiz Title:</label>
                        <div class="col-sm-9">
                            <input id="title" name="title" type="text" class="form-control" disabled value="{{ $quiz->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course_title" class="col-sm-3 col-form-label form-label">Student Year: </label>
                        <div class="col-sm-9 col-md-4">
                            <select id="student_year_id" name="student_year_id" disabled class="custom-select form-control">
                                <option value="4" {{ $quiz->student_year_id == 4 ? 'selected' : '' }}>Form 4</option>
                                <option value="5" {{ $quiz->student_year_id == 5 ? 'selected' : '' }}>Form 5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course_title" class="col-sm-3 col-form-label form-label">Chapter: </label>
                        <div class="col-sm-9 col-md-4">
                            <select id="chapter_id" name="chapter_id" disabled class="custom-select form-control">
                                <option value="{{ $quiz->chapter_id }}">{{ $quiz->chapter->name }}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Questions</h4>
            </div>
            <div class="card-header">
                <a href="#" data-toggle="modal" data-target="#create-quiz" class="btn btn-outline-secondary">Add Question
                    <i class="material-icons">add</i></a>
            </div>
            <div class="nestable" id="nestable">
                <ul id="questions" class="list-group list-group-fit nestable-list-plain mb-0">
                    @foreach ($quiz->quiz_questions as $quiz_question)
                        <li class="list-group-item nestable-item">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <a href="#" class="btn btn-default nestable-handle"><i class="material-icons">menu</i></a>
                                </div>
                                <div class="media-body">
                                    {{ $quiz_question->title }}
                                </div>
                                <div class="media-right text-right">
                                    <div style="width:100px">
                                        <a href="#!" onclick="edit_question({{ $quiz_question->id }})" data-toggle="modal" data-target="#editQuiz" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@include('student.quiz.create-question')

@push('js')
    <!-- Vendor JS -->
    {{-- <script src="{{ asset('assets/vendor/jquery.nestable.js') }}"></script>

    <!-- Initialize -->
    <script src="{{ asset('assets/js/nestable.js') }}"></script> --}}

    <script>
        function edit_question(question_id) {
            var url = `{{ route('quiz.edit.question', ':id') }}`;
            url = url.replace(':id', question_id);
            $('#modal-div').load(url);
        }
    </script>
@endpush
