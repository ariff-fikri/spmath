@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h1 class="m-lg-0">Quiz #1</h1>
                <div class="d-inline-flex align-items-center">
                    <i class="material-icons icon-16pt mr-1 text-muted">school</i> <a href="#" class="text-muted">Function and Quadratic Equation in One Variable</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        <div class="alert alert-soft-blue d-flex align-items-center card-margin p-2" role="alert">
            <i class="material-icons mr-3">info</i>
            <div class="text-body">Your currently answered to <strong class="text-primary">5 correct</strong> questions. </div>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="media align-items-center">
                            <div class="media-left">
                                <h4 class="m-0 text-primary mr-2"><strong>#1</strong></h4>
                            </div>
                            <div class="media-body">
                                <h4 class="card-title m-0">
                                    What is the axis of symmetry for the following equation?
                                    <br>y = 4x<sup>2</sup> - 8x + 9
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input id="customCheck01" type="checkbox" checked class="custom-control-input">
                                <label for="customCheck01" class="custom-control-label"> x=-8</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input id="customCheck02" type="checkbox" class="custom-control-input">
                                <label for="customCheck02" class="custom-control-label">x=-1</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input id="customCheck03" type="checkbox" class="custom-control-input">
                                <label for="customCheck03" class="custom-control-label">x=1</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-light">Skip</a>
                        <a href="#" class="btn btn-success float-right">Submit <i class="material-icons btn__icon--right">arrow_forward</i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">

                <div class="list-group">

                    <a href="#" class="list-group-item active">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#1</span>
                            </span>
                            <span class="media-body">
                                What is the axis of symmetry for the following equation?
                                <br>y = 4x<sup>2</sup> - 8x + 9
                            </span>
                        </span>
                    </a>


                    <a href="#" class="list-group-item">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#2</span>
                            </span>
                            <span class="media-body">
                                What is the y intercept for the equation: <br>y = -8x<sup>2</sup> + 3x - 7
                            </span>
                        </span>
                    </a>


                    <a href="#" class="list-group-item">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#3</span>
                            </span>
                            <span class="media-body">
                                Solve the quadratic equation, <br>(y + 3)(y – 4) = 30 
                            </span>
                        </span>
                    </a>


                    <a href="#" class="list-group-item">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#4</span>
                            </span>
                            <span class="media-body">
                                Final Question?
                            </span>
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
