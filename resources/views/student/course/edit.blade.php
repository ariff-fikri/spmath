@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Edit Chapter</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-form__body card-body">
                        <div class="form-group">
                            <label for="fname">Title</label>
                            <input id="fname" type="text" class="form-control" placeholder="Title goes here" value="Course title is editable here">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea id="desc" rows="4" class="form-control" placeholder="Please enter a description"></textarea>
                        </div>

                    </div>
                    <div class="card-body text-center">

                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <!-- Lessons -->

                    <div class="card-header card-header-large bg-light d-flex align-items-center">

                        <h4 class="card-header__title">Lesson Images</h4>
                    </div>

                    <div class="card-body">
                        <h4 class="card-header__title text-muted">Preview</h4>
                        <div id="carouselExampleIndicators" class="carousel slide embed-responsive" data-ride="false" data-interval="false" style="padding: 5%;">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                              </ol>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('assets/images/logos/react.svg') }}" alt="First slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets/images/logos/react.svg') }}" alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets/images/logos/react.svg') }}" alt="Third slide">
                              </div>
                            </div>
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

                        <h4 class="card-header__title text-muted mt-4">File uploads</h4>
                        <div class="form-group mb-3">
                            <form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>
                        </div>
                        <button class="btn btn-primary btn-block">Update Video</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
