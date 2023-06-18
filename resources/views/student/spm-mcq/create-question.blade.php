<div class="modal fade" id="create-quiz">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Add Question</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('spm_mcq.question.store') }}" id="form-store-quiz-question" class="needs-validation" method="POST">
                    @csrf
                    <input type="hidden" name="spm_mcq_id" value="{{ $quiz->id }}">
                    <div class="form-group row">
                        <label for="title" class="col-form-label form-label col-md-3">Title:</label>
                        <div class="col-md-9">
                            <input id="title" name="title" type="text" class="form-control" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label form-label col-md-3">Answers Choice:</label>
                        <div class="col-md-9">
                            <input id="choice_a" name="choice_a" type="text" class="form-control" placeholder="Choice A" required><br>
                            <input id="choice_b" name="choice_b" type="text" class="form-control" placeholder="Choice B" required><br>
                            <input id="choice_c" name="choice_c" type="text" class="form-control" placeholder="Choice C" required><br>
                            <input id="choice_d" name="choice_d" type="text" class="form-control" placeholder="Choice D" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label form-label col-md-3">Correct Answer:</label>
                        <div class="col-md-4">
                            <div class="custom-control custom-radio">
                                <input id="radio-a" name="correct_answer" type="radio" class="custom-control-input" value="a">
                                <label for="radio-a" class="custom-control-label"> A</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="radio-b" name="correct_answer" type="radio" class="custom-control-input" value="b">
                                <label for="radio-b" class="custom-control-label"> B</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="radio-c" name="correct_answer" type="radio" class="custom-control-input" value="c">
                                <label for="radio-c" class="custom-control-label"> C</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="radio-d" name="correct_answer" type="radio" class="custom-control-input" value="d">
                                <label for="radio-d" class="custom-control-label"> D</label>
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
