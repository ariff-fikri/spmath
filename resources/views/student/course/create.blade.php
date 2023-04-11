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
            <div class="col-md-12">
                <form action="{{ route('chapter.store') }}" method="POST">
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
                            </div>

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea id="desc" name="description" rows="4" class="form-control" placeholder="Please enter a description"></textarea>
                            </div>

                        </div>
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
