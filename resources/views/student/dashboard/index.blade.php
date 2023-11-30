@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">{{ auth()->user() ? 'Admin' : '' }} Dashboard</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        <div class="row">
            <div class="col-md-6">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span><img src="assets/images/logos/form-5.png" class="mb-1" style="width:34px;" alt="logo"></span>
                            <span class="course__title">Form 4</span>
                            <span class="course__subtitle">{{ $chaptersCountForm4 }} Chapters</span>
                        </a>
                    </div>
                    <div class="p-3">
                        @foreach ($chaptersForm4 as $key => $chapter)
                            <div class="mb-2">
                                <strong>{{ $chapter->name }}</strong><br />
                                <small class="text-muted">Chapter {{ $chapter->id }}</small>
                            </div>
                        @endforeach
                        <div class="d-flex align-items-center">
                            <a href="{{ route('chapter.index') }}" class="btn btn-primary ml-auto">Show More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span><img src="assets/images/logos/form-5.png" class="mb-1" style="width:34px;" alt="logo"></span>
                            <span class="course__title">Form 5</span>
                            <span class="course__subtitle">{{ $chaptersCountForm5 }} Chapters</span>
                        </a>
                    </div>
                    <div class="p-3">
                        @foreach ($chaptersForm5 as $key => $chapter)
                            <div class="mb-2">
                                <strong>{{ $chapter->name }}</strong><br />
                                <small class="text-muted">Chapter {{ $chapter->id }}</small>
                            </div>
                        @endforeach
                        <div class="d-flex align-items-center">
                            <a href="{{ route('chapter.index') }}" class="btn btn-primary ml-auto">Show More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr>

    </div>
@endsection