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
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-form__body card-body">
                        <div class="form-group">
                            <label for="fname">Title</label>
                            <input id="fname" type="text" class="form-control" placeholder="Title goes here" value="">
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
                        <!-- Lessons -->
                        <style>
                            .dropzone {
                                border: 1px solid rgb(192, 192, 192);
                                color: rgb(192, 192, 192);
                            }
                        </style>

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
