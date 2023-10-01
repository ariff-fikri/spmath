@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h1 class="m-lg-0">Create SPM MCQ</h1>
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
        @if (Session::has('error'))
            <div class="alert alert-soft-danger d-flex" role="alert">
                <i class="fa fa-times mr-3"></i>
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">SPM MCQ Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('spm_mcq.store') }}" id="form-store-quiz" class="needs-validation" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">MCQ Title:</label>
                        <div class="col-sm-9">
                            <input id="title" name="title" type="text" class="form-control" required placeholder="Title">
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