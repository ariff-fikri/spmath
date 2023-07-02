@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h1 class="m-lg-0">Add Past Year Paper</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .dropzone {
            border: 1px solid rgb(192, 192, 192);
            color: rgb(192, 192, 192);
        }
    </style>
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Past Year Paper Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('past-year.store') }}" id="form-store-pastyear" class="needs-validation" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label form-label">Title:</label>
                        <div class="col-sm-9">
                            <input id="name" name="name" type="text" class="form-control" required placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paper_type" class="col-sm-3 col-form-label form-label">Paper Type: </label>
                        <div class="col-sm-9">
                            <select id="paper_type" name="paper_type" class="custom-select form-control">
                                <option value="1">Paper 1</option>
                                <option value="2">Paper 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label form-label">Description:</label>
                        <div class="col-sm-9">
                            <textarea id="description" name="description" type="text" class="form-control" required placeholder="Title"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="student_year_id" class="col-sm-3 col-form-label form-label">Student Year: </label>
                        <div class="col-sm-9">
                            <select id="student_year_id" name="student_year_id" class="custom-select form-control">
                                <option value="4">Form 4</option>
                                <option value="5">Form 5</option>
                            </select>
                        </div>
                    </div>
                </form>

                <div class="form-group mb-3">
                    <form action="{{ route('past-year.store') }}" method="POST" class="dropzone" id="my-awesome-dropzone">
                        @csrf
                        <div class="dz-message" data-dz-message><span>Drop PDF File Here to Upload</span></div>
                    </form>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="button" class="btn-submit btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        Dropzone.autoDiscover = false;
            
        var myDropzone = new Dropzone("#my-awesome-dropzone", {
            autoProcessQueue: false,
            uploadMultiple:false,
            parallelUploads: 10,
            acceptedFiles: ".pdf",
            init: function () {
                myDropzone = this;

                this.on('sending', function (file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#form-store-pastyear').serializeArray();
                    $.each(data, function (key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("addedfile", function (file) {

                    var removeButton = Dropzone.createElement(`<a class="dz-remove" href="javascript:undefined;">Remove file</a>`);

                    var _this = this;

                    removeButton.addEventListener("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        _this.removeFile(file);
                    });

                    file.previewElement.appendChild(removeButton);
                });
            }
        });

        var form = document.querySelector('.needs-validation');

        $(".btn-submit").click(function (e) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

            } else {

                if (myDropzone.getQueuedFiles().length > 0) {
                    myDropzone.processQueue();
                    myDropzone.on("queuecomplete", function (file) {
                        window.location.href = "/past-year";
                    });
                } else {
                    form.submit();
                }
            }

            form.classList.add('was-validated');
        });
    </script>
@endpush
