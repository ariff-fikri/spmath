@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="col-md-8">
                <h1 class="m-lg-0">{{ $chapter->name }}</h1>
                <div class="d-inline-flex align-items-center">
                    <small class="text-muted ml-1 mr-1">{{ $chapter->description ?? '' }}</small>
                </div>
            </div>
            <div class="col-md-4">
                <a href="{{ route('chapter.download', $chapter->id) }}" class="btn btn-success mt-2">
                    Download e-Notes
                </a>
                <a href="{{ route('quiz.index') }}" class="btn btn-info mt-2">
                    Do Quiz
                </a>
                @if (auth()->user())
                    <a href="{{ route('chapter.edit', $chapter->id) }}" class="btn btn-primary mt-2">
                        Edit Chapter
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
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
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Chapter Description</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $chapter->description ?? '' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            refresh_preview();
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
    </script>
@endpush