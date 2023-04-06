@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">{{ auth()->user() ? 'Admin' : '' }} Courses</h1>
            <div>
                @if (auth()->user())
                    <a href="{{ route('course.create') }}" class="btn btn-info">
                        New Course
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        <div class="row">

            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span class="course__title">Chapter 1</span>
                            <span class="course__subtitle">Quadratic Equations</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Description of the chapter given.</strong><br />
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.show') }}" class="btn btn-primary ml-auto">Go to course <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span class="course__title">Chapter 1</span>
                            <span class="course__subtitle">Quadratic Equations</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Description of the chapter given.</strong><br />
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.show') }}" class="btn btn-primary ml-auto">Go to course <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span class="course__title">Chapter 1</span>
                            <span class="course__subtitle">Quadratic Equations</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Description of the chapter given.</strong><br />
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.show') }}" class="btn btn-primary ml-auto">Go to course <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span class="course__title">Chapter 1</span>
                            <span class="course__subtitle">Quadratic Equations</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Description of the chapter given.</strong><br />
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.show') }}" class="btn btn-primary ml-auto">Go to course <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span class="course__title">Chapter 1</span>
                            <span class="course__subtitle">Quadratic Equations</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Description of the chapter given.</strong><br />
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.show') }}" class="btn btn-primary ml-auto">Go to course <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span class="course__title">Chapter 1</span>
                            <span class="course__subtitle">Quadratic Equations</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Description of the chapter given.</strong><br />
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.show') }}" class="btn btn-primary ml-auto">Go to course <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr>

    </div>
@endsection