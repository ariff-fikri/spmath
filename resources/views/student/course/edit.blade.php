@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Edit Chapter</h1>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .dz-image img{
        width: 130px;
        height:130px;
    }
    </style>
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-7">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('chapter.update', $chapter->id) }}" method="POST">
                            @csrf
                            <div class="card-form__body card-body">
                                <div class="form-group">
                                    <label for="student_year_id">Student Year:</label><br />
                                    <select id="student_year_id" name="student_year_id" class="custom-select w-auto">
                                        <option value="4" {{ $chapter->student_year_id == 4 ? 'selected' : '' }}>Form 4</option>
                                        <option value="5" {{ $chapter->student_year_id == 5 ? 'selected' : '' }}>Form 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fname">Title</label>
                                    <input id="fname" name="name" type="text" class="form-control" placeholder="Title goes here" value="{{ $chapter->name }}">
                                </div>
    
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea id="desc" name="description" rows="4" class="form-control" placeholder="Please enter a description">{{ $chapter->description ?? '' }}</textarea>
                                </div>
    
                            </div>
                            <div class="card-body text-center">
    
                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </div>
                        </form>
                    </div>
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
                            <h4 class="card-header__title text-muted">Preview</h4>
                            <div id="carouselExampleIndicators" class="carousel slide embed-responsive" data-ride="false" data-interval="false" style="padding: 5%;">
                                <ol class="carousel-indicators indicator-div">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
    
                                <div class="carousel-inner preview-div"></div>
    
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!-- Lessons -->
                            <style>
                                .dropzone {
                                    border: 1px solid rgb(192, 192, 192);
                                    color: rgb(192, 192, 192);
                                }
                            </style>
    
                            <h4 class="card-header__title text-muted mt-4">Image uploads</h4>
                            <div class="form-group mb-3">
                                <form action="{{ route('chapter.file', $chapter->id) }}" method="POST" class="dropzone" id="my-awesome-dropzone">
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
                                <form action="{{ route('chapter.file', $chapter->id) }}" method="POST" class="dropzone" id="my-awesome-dropzone2">
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
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            init: function () {
                myDropzone = this;

                refresh_preview();

                $.ajax({
                    url: `{{ route('chapter.read_files', $chapter->id) }}`,
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {

                        $.each(response, function (key, value) {
                            if (!value.name.includes('.pdf')) {
                                var mockFile = {
                                    name: value.name,
                                    size: value.size
                                };

                                myDropzone.emit("addedfile", mockFile);
                                myDropzone.emit("thumbnail", mockFile, value.path);
                                myDropzone.emit("complete", mockFile);
                            }

                        });

                    }
                });

                this.on("addedfile", function (file) {

                    var removeButton = Dropzone.createElement(`<a class="dz-remove" href="javascript:undefined;">Remove file</a>`);

                    var _this = this;

                    removeButton.addEventListener("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        _this.removeFile(file);

                        $.ajax({
                            url: `{{ route('chapter.remove_files', $chapter->id) }}`,
                            type: 'post',
                            dataType: 'json',
                            data: {
                                _token: `{{ csrf_token() }}`,
                                file_name: file.name,
                                file_dir: file.previewElement.baseURI
                            },
                            success: function (response) {
                                console.log(response);

                                refresh_preview();
                            }
                        });
                    });

                    file.previewElement.appendChild(removeButton);
                });

                this.on("complete", function(file) {
                    refresh_preview();
                });
            }
        });

        var myDropzone2 = new Dropzone("#my-awesome-dropzone2", {
            maxFilesize: 2,
            acceptedFiles: ".pdf,.zip",
            init: function () {
                myDropzone2 = this;

                refresh_preview2();

                $.ajax({
                    url: `{{ route('chapter.read_files', $chapter->id) }}`,
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {

                        $.each(response, function (key, value) {

                            if (value.name.includes('.pdf')) {
                                var mockFile = {
                                    name: value.name,
                                    size: value.size,
                                };

                                myDropzone2.emit("addedfile", mockFile);
                                myDropzone2.emit("thumbnail", mockFile, `{{ asset('assets/images/icons/pdf17.svg') }}`);
                                myDropzone2.emit("complete", mockFile);
                            }

                        });

                    }
                });

                this.on("addedfile", function (file) {

                    var removeButton = Dropzone.createElement(`<a class="dz-remove" href="javascript:undefined;">Remove file</a>`);

                    var _this = this;

                    removeButton.addEventListener("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        _this.removeFile(file);

                        $.ajax({
                            url: `{{ route('chapter.remove_files', $chapter->id) }}`,
                            type: 'post',
                            dataType: 'json',
                            data: {
                                _token: `{{ csrf_token() }}`,
                                file_name: file.name,
                                file_dir: file.previewElement.baseURI
                            },
                            success: function (response) {
                                console.log(response);

                                refresh_preview();
                            }
                        });
                    });

                    file.previewElement.appendChild(removeButton);
                });

                this.on("complete", function(file) {
                    refresh_preview();
                });
            }
        });

        function refresh_preview() {

            $.ajax({
                url: `{{ route('chapter.preview', $chapter->id) }}`,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('.indicator-div').empty();
                    $('.preview-div').empty();

                    var count = 0;
                    if (response.chapter_files.length > 0) {
                        response.chapter_files.forEach((chapter_file, index) => {
                            if (!chapter_file.name.includes(".pdf")) {
                                $('.preview-div').append(`
                                    <div class="carousel-item ${count == 0 ? 'active' : ''}">
                                        <img class="d-block w-100" src="${chapter_file.url}" alt="${chapter_file.name} slide">
                                    </div>
                                `);

                                $('.indicator-div').append(`
                                    <li data-target="#carouselExampleIndicators" data-slide-to="${count}" class="${count == 0 ? 'active' : ''}"></li>
                                `);
                                count++;
                            }
                        });
                    } else {
                        $('.preview-div').append(`
                            <div class="carousel-item active text-center">
                                <img class="d-block w-100" src="{{ asset('assets/images/empty-state/2.png') }}" style="opacity: 50%" alt="2 slide">
                                <div class="card-header__title text-muted mt-5 mb-5"><span>No Images Available</span></div>
                            </div>
                        `);

                        $('.indicator-div').append(`
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        `);
                    }
                }
            });
        }

        function refresh_preview2() {

            $.ajax({
                url: `{{ route('chapter.preview', $chapter->id) }}`,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('.indicator2-div').empty();
                    $('.preview2-div').empty();

                    var count = 0;
                    if (response.chapter_files.length > 0) {
                        response.chapter_files.forEach((chapter_file, index) => {
                            if (!chapter_file.name.includes(".pdf")) {
                                $('.preview2-div').append(`
                                    <div class="carousel-item ${count == 0 ? 'active' : ''}">
                                        <img class="d-block w-100" src="${chapter_file.url}" alt="${chapter_file.name} slide">
                                    </div>
                                `);

                                $('.indicator2-div').append(`
                                    <li data-target="#carouselExampleIndicators" data-slide-to="${count}" class="${count == 0 ? 'active' : ''}"></li>
                                `);
                                count++;
                            }
                        });
                    } else {
                        $('.preview2-div').append(`
                            <div class="carousel-item active text-center">
                                <img class="d-block w-100" src="{{ asset('assets/images/empty-state/2.png') }}" style="opacity: 50%" alt="2 slide">
                                <div class="card-header__title text-muted mt-5 mb-5"><span>No Images Available</span></div>
                            </div>
                        `);

                        $('.indicator2-div').append(`
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        `);
                    }
                }
            });
        }
    </script>
@endpush