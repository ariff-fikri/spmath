@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Past Year Papers</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        <div class="card-header card-header-tabs-basic nav" role="tablist">
            <a href="#paper_1" class="active" data-toggle="tab" role="tab" aria-controls="paper_1" aria-selected="true">Paper 1</a>
            <a href="#paper_2" data-toggle="tab" role="tab" aria-controls="paper_2" aria-selected="false">Paper 2</a>
        </div>

        <div class="card-body tab-content">
            <div class="tab-pane active show fade" id="paper_1">
                <div class="row">
                    @foreach ($past_years->where('paper_type', 1) as $past_year)
                        <div class="col-md-3">
                            <div class="card card__course">
                                <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                    <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                                        <span class="course__title">{{ $past_year->name ?? '' }}</span>
                                        <span class="course__subtitle">Mathematics SPM</span>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <div class="mb-2">
                                        <strong>{{ $past_year->description ?? '' }}</strong><br />
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ asset($past_year->file_dir . $past_year->file_name) }}" download class="btn btn-primary ml-auto">Download <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane active fade" id="paper_2">
                <div class="row">
                    @foreach ($past_years->where('paper_type', 2) as $past_year)
                        <div class="col-md-3">
                            <div class="card card__course">
                                <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                    <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                                        <span class="course__title">{{ $past_year->name ?? '' }}</span>
                                        <span class="course__subtitle">Mathematics SPM</span>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <div class="mb-2">
                                        <strong>{{ $past_year->description ?? '' }}</strong><br />
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ asset($past_year->file_dir . $past_year->file_name) }}" download class="btn btn-primary ml-auto">Download <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>

    </div>
@endsection