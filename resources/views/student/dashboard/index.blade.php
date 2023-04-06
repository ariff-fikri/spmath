@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">{{ auth()->user() ? 'Admin' : '' }} Dashboard</h1>
            {{-- <a href="" class="btn btn-success ml-3">Go to Courses <i class="material-icons">arrow_forward</i></a> --}}
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">   
        {{-- <form action="#" class="">
            <div class="d-lg-flex">
                <div class="search-form mb-3 mr-3-lg search-form--light">
                    <input type="text" class="form-control" placeholder="Search courses" id="searchSample02">
                    <button class="btn" type="button"><i class="material-icons">search</i></button>
                </div>

                <div class="form-inline  mb-3 ml-auto">
                    <div class="form-group mr-3">
                        <label for="custom-select" class="form-label mr-1">Category</label>
                        <select id="custom-select" class="form-control custom-select" style="width: 200px;">
                            <option selected>All categories</option>
                            <option value="1">Vue.js</option>
                            <option value="2">Node.js</option>
                            <option value="3">GitHub</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="published01" class="form-label mr-1">Status</label>
                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                            <option selected>All</option>
                            <option value="1">In Progress</option>
                            <option value="3">New Releases</option>
                        </select>
                    </div>
                </div>
            </div>
        </form> --}}

        <div class="row">

            <div class="col-md-6">
                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                            <span><img src="assets/images/logos/form-5.png" class="mb-1" style="width:34px;" alt="logo"></span>
                            <span class="course__title">Form 4</span>
                            <span class="course__subtitle">4 Chapters</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Learn all the basics of tahdfwad awda wdawdawd</strong><br />
                            <small class="text-muted">Chapter 1</small>
                        </div>
                        <div class="mb-2">
                            <strong>Learn all the basics of tahdfwad awda wdawdawd</strong><br />
                            <small class="text-muted">Chapter 1</small>
                        </div>
                        <div class="mb-2">
                            <strong>Learn all the basics of tahdfwad awda wdawdawd</strong><br />
                            <small class="text-muted">Chapter 1</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary ml-auto">Show More <i class="fa fa-arrow-right"></i></a>
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
                            <span class="course__subtitle">6 Chapters</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <strong>Learn all the basics of tahdfwad awda wdawdawd</strong><br />
                            <small class="text-muted">Chapter 1</small>
                        </div>
                        <div class="mb-2">
                            <strong>Learn all the basics of tahdfwad awda wdawdawd</strong><br />
                            <small class="text-muted">Chapter 1</small>
                        </div>
                        <div class="mb-2">
                            <strong>Learn all the basics of tahdfwad awda wdawdawd</strong><br />
                            <small class="text-muted">Chapter 1</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary ml-auto">Show More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr>
        {{-- <div class="d-flex flex-row align-items-center mb-3">
            <div class="form-inline">
                View
                <select class="custom-select ml-2">
                    <option value="20" selected>20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
            </div>
            <div class="ml-auto">
                20 <span class="text-muted">of 100</span> <a href="#" class="icon-muted"><i class="material-icons float-right">arrow_forward</i></a>
            </div>
        </div> --}}

    </div>
@endsection