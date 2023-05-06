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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Quiz Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('quiz.store') }}" id="form-store-quiz" class="needs-validation" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quiz Title:</label>
                        <div class="col-sm-9">
                            <input id="title" name="title" type="text" class="form-control" required placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course_title" class="col-sm-3 col-form-label form-label">Student Year: </label>
                        <div class="col-sm-9 col-md-4">
                            <select id="student_year_id" name="student_year_id" class="custom-select form-control">
                                <option value="4">Form 4</option>
                                <option value="5">Form 5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course_title" class="col-sm-3 col-form-label form-label">Chapter: </label>
                        <div class="col-sm-9 col-md-4">
                            <select id="chapter_id" name="chapter_id" class="custom-select form-control">
                                @foreach ($chapters->where('student_year_id', 4) as $chapter)
                                    <option value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Vendor JS -->
    {{-- <script src="{{ asset('assets/vendor/jquery.nestable.js') }}"></script>

    <!-- Initialize -->
    <script src="{{ asset('assets/js/nestable.js') }}"></script> --}}

    <script>
        var chapters = @json($chapters);
        $('#student_year_id').on('change', function() {
            if ($(this).val() == '4') {
                $('#chapter_id').empty();
                chapters_filter = chapters.filter(chapter => chapter.student_year_id === 4);

                chapters_filter.forEach(element => {
                    $('#chapter_id').append(
                        `<option value="${element.id}">${element.name}</option>`
                    );
                });

            } else {
                $('#chapter_id').empty();
                chapters_filter = chapters.filter(chapter => chapter.student_year_id === 5);

                chapters_filter.forEach(element => {
                    $('#chapter_id').append(
                        `<option value="${element.id}">${element.name}</option>`
                    );
                });
            }
        })

        function edit_question(question_id) {
            var url = '';
            $('#modal-div').load(url);
        }

        // window.onbeforeunload = function() {
        //     return "Are you sure?";
        // };

        // window.onkeydown = function(event) {
        //     if (event.keyCode === 116) {
        //         window.location.reload();
        //     }
        // };
    </script>
@endpush
