<div class="modal fade show" id="edit-quiz">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Question</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('spm_mcq.update.question', $spm_mcq_question->id) }}" id="form-update-quiz-question" class="needs-validation" method="POST">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $spm_mcq_question->quiz_id }}">
                    <div class="form-group row">
                        <label for="title" class="col-form-label form-label col-md-3">Title:</label>
                        <div class="col-md-9">
                            <input id="title" name="title" type="text" class="form-control" placeholder="Title" required value="{{ $spm_mcq_question->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label form-label col-md-3">Answers Choice:</label>
                        <div class="col-md-9">
                            <input id="choice_a" name="choice_a" type="text" class="form-control" placeholder="Choice A" value="{{ $spm_mcq_question->choice_a }}"><br>
                            <input id="choice_b" name="choice_b" type="text" class="form-control" placeholder="Choice B" value="{{ $spm_mcq_question->choice_b }}"><br>
                            <input id="choice_c" name="choice_c" type="text" class="form-control" placeholder="Choice C" value="{{ $spm_mcq_question->choice_c }}"><br>
                            <input id="choice_d" name="choice_d" type="text" class="form-control" placeholder="Choice D" value="{{ $spm_mcq_question->choice_d }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label form-label col-md-3">Correct Answer:</label>
                        <div class="col-md-4">
                            <div class="custom-control custom-radio">
                                <input id="radio-a-edit" name="correct_answer" type="radio" class="custom-control-input" {{ $spm_mcq_question->correct_answer == 'a' ? 'checked' : '' }} value="a">
                                <label for="radio-a-edit" class="custom-control-label"> A</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="radio-b-edit" name="correct_answer" type="radio" class="custom-control-input" {{ $spm_mcq_question->correct_answer == 'b' ? 'checked' : '' }} value="b">
                                <label for="radio-b-edit" class="custom-control-label"> B</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="radio-c-edit" name="correct_answer" type="radio" class="custom-control-input" {{ $spm_mcq_question->correct_answer == 'c' ? 'checked' : '' }} value="c">
                                <label for="radio-c-edit" class="custom-control-label"> C</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="radio-d-edit" name="correct_answer" type="radio" class="custom-control-input" {{ $spm_mcq_question->correct_answer == 'd' ? 'checked' : '' }} value="d">
                                <label for="radio-d-edit" class="custom-control-label"> D</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#edit-quiz').modal('show');
</script>
