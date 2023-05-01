@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Create Chapter</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">
        @if(Session::has('success'))
            <div class="alert alert-soft-success d-flex" role="alert">
                <i class="fa fa-check mr-3"></i>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-md-7">
                <div class="col-md-12">
                    <form action="{{ route('chapter.store') }}" id="form-store-course" class="needs-validation" novalidate method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-form__body card-body">
                                <div class="form-group">
                                    <label for="category">Student Year:</label><br />
                                    <select id="category" name="student_year_id" class="custom-select w-auto">
                                        <option value="4">Form 4</option>
                                        <option value="5">Form 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fname">Title</label>
                                    <input id="fname" name="name" type="text" class="form-control" placeholder="Title goes here" value="" required>
                                    <div class="invalid-feedback">
                                        Please state a title.
                                      </div>
                                </div>
    
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea id="desc" name="description" rows="4" class="form-control" placeholder="Please enter a description"></textarea>
                                </div>
    
                            </div>
                            <div class="card-body text-center">
                                <button type="button" class="btn btn-success btn-submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Lessons -->
                        <div class="card-header card-header-large bg-light d-flex align-items-center">
        
                            <h4 class="card-header__title">Lesson Images</h4>
                        </div>
        
                        <div class="card-body">
                            <!-- Lessons -->
                            <style>
                                .dropzone {
                                    border: 1px solid rgb(192, 192, 192);
                                    color: rgb(192, 192, 192);
                                }
                            </style>
        
                            <h4 class="card-header__title text-muted mt-4">Image uploads</h4>
                            <div class="form-group mb-3">
                                <form action="{{ route('chapter.store') }}" method="POST" class="dropzone" id="my-awesome-dropzone">
                                    @csrf
                                    <div class="dz-message" data-dz-message><span>Drop Image Here to Upload</span></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <!-- Lessons -->
                        <div class="card-header card-header-large bg-light d-flex align-items-center">
        
                            <h4 class="card-header__title">Lesson Files</h4>
                        </div>
        
                        <div class="card-body">
                            <!-- Lessons -->
                            <style>
                                .dropzone {
                                    border: 1px solid rgb(192, 192, 192);
                                    color: rgb(192, 192, 192);
                                }
                            </style>
        
                            <h4 class="card-header__title text-muted mt-4">File uploads</h4>
                            <div class="form-group mb-3">
                                <form action="{{ route('chapter.store') }}" method="POST" class="dropzone" id="my-awesome-dropzone2">
                                    @csrf
                                    <div class="dz-message" data-dz-message><span>Drop Files Here to Upload</span></div>
                                </form>
                            </div>
                        </div>
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
            uploadMultiple:true,
            parallelUploads: 10,
            acceptedFiles: ".jpeg,.jpg,.png",
            init: function () {
                myDropzone = this;

                this.on('sending', function (file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#form-store-course').serializeArray();
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

        var myDropzone2 = new Dropzone("#my-awesome-dropzone2", {
            autoProcessQueue: false,
            uploadMultiple:true,
            parallelUploads: 10,
            acceptedFiles: ".pdf",
            init: function () {
                myDropzone2 = this;

                this.on('sending', function (file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#form-store-course').serializeArray();
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

                if (myDropzone.getQueuedFiles().length > 0 && myDropzone2.getQueuedFiles().length < 0) {
                    myDropzone.processQueue();
                    myDropzone.on("queuecomplete", function (file) {
                        window.location.href = "/chapter";
                    });
                } else if(myDropzone2.getQueuedFiles().length > 0 && myDropzone.getQueuedFiles().length < 0) { 
                    myDropzone2.processQueue();
                    myDropzone2.on("queuecomplete", function (file) {
                        window.location.href = "/chapter";
                    });                
                } else if(myDropzone.getQueuedFiles().length > 0 && myDropzone2.getQueuedFiles().length > 0) { 
                    myDropzone.processQueue();
                    myDropzone.on("queuecomplete", function (file) {
                        myDropzone2.processQueue();
                        myDropzone2.on("queuecomplete", function (file) {
                            window.location.href = "/chapter";
                        }); 
                    });
                } else {
                    form.submit();
                }
            }

            form.classList.add('was-validated');
        });
        
    </script>
@endpush
