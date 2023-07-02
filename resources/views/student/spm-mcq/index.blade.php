@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h1 class="m-lg-0">SPM MCQ</h1>
                <div class="d-inline-flex align-items-center">
                    <i class="material-icons icon-16pt mr-1 text-muted">school</i> <a href="#" class="text-muted">{{ $spm_mcq->title }}</a>
                </div>
            </div>

            <div id="countdown-timer" class="countdown sidebar-p-x" data-value="5" data-unit="second"></div>

        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        {{-- <div class="alert alert-soft-blue d-flex align-items-center card-margin p-2" role="alert">
            <i class="material-icons mr-3">info</i>
            <div class="text-body">Your currently answered to <strong class="text-primary">5 correct</strong> questions. </div>
        </div> --}}

        <form action="{{ route('spm_mcq.submit_answer', $spm_mcq->id) }}" method="POST" id="quiz-submit-form">
            @csrf
            
            <div class="row">
                <div class="col-md-8 tab-content" id="quizTabContent">
                    @foreach ($spm_mcq->quiz_questions as $key => $question)
                        <div class="tab-pane fade show @once active @endonce" id="quiz-{{ $question->id }}" role="tabpanel" aria-labelledby="quiz-{{ $question->id }}-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="media align-items-center">
                                        <div class="media-left">
                                            <h4 class="m-0 text-primary mr-2"><strong>#{{ $loop->iteration }}</strong></h4>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="card-title m-0">
                                                {!! $question->title !!}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input id="choice_a_question_{{ $question->id }}" type="radio" name="question[{{ $question->id }}]" value="a" class="question custom-control-input">
                                            <label for="choice_a_question_{{ $question->id }}" class="custom-control-label">{{ $question->choice_a }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input id="choice_b_question_{{ $question->id }}" type="radio" name="question[{{ $question->id }}]" value="b" class="question custom-control-input">
                                            <label for="choice_b_question_{{ $question->id }}" class="custom-control-label">{{ $question->choice_b }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input id="choice_c_question_{{ $question->id }}" type="radio" name="question[{{ $question->id }}]" value="c" class="question custom-control-input">
                                            <label for="choice_c_question_{{ $question->id }}" class="custom-control-label">{{ $question->choice_c }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input id="choice_d_question_{{ $question->id }}" type="radio" name="question[{{ $question->id }}]" value="d" class="question custom-control-input">
                                            <label for="choice_d_question_{{ $question->id }}" class="custom-control-label">{{ $question->choice_d }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if($loop->last)
                                        <a href="#" class="btn btn-success float-right submit">Submit <i class="material-icons btn__icon--right">arrow_forward</i></a>
                                    @else
                                        <a href="#" class="btn btn-success float-right continue">Next <i class="material-icons btn__icon--right">arrow_forward</i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="quizTab" class="nav col-md-4" role="tablist">

                    <div class="list-group nav-item" role="presentation">

                        @foreach ($spm_mcq->quiz_questions as $key => $question)
                            <a href="#" class="list-group-item nav-link @once active @endonce" id="quiz-{{ $question->id }}-tab" data-toggle="tab" data-target="#quiz-{{ $question->id }}" role="tab" type="button">
                                <span class="media align-items-center">
                                    <span class="media-left mr-2">
                                        <span class="btn btn-light btn-sm">#{{ $loop->iteration }}</span>
                                    </span>
                                    <span class="media-body">
                                        {!! $question->title !!}
                                    </span>
                                </span>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/jquery.countdown.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/countdown.js') }}"></script> --}}
    <script>
        // Set the date we're counting down to
        var oldDate = new Date();
        var hour = oldDate.getMinutes();
        var newDate = oldDate.setMinutes(hour + 90);
        var countDownDate = newDate;
        var start_time = new Date().getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
                
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            // Output the result in an element with id="demo"
            $('.countdown').html(hours + "h " + minutes + "m " + seconds + "s ");
            $('#time').val(now - start_time);

            console.log($('#time').val());
                
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                $('.countdown').html('TIME OUT');
            } 
        }, 1000);
        
        $('.continue').click(function () {
            $('.nav-item > .active').next('a').trigger('click');
        });

        quiz = @json($spm_mcq);

        console.log(quiz);

        $('.submit').click(function () {
            console.log('masuk');
            Swal.fire({
                title: "Are you sure you want to submit this quiz?",
                text: "Please check all answers before submitting.",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Submit",
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: "btn btn-success mr-2",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    validation = true;

                    quiz.quiz_questions.forEach(element => {
                        if (!$(`input[name='question[${element.id}]']:checked`).val()) {
                            validation = false;
                        }
                    });

                    if (validation) {
                        $('#quiz-submit-form').submit();
                    } else {
                        Swal.fire('Oops!', 'Please ensure all questions have been answered.', 'error');
                    }
                }
            });
        });
    </script>
@endpush
