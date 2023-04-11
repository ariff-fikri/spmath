@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">{{ auth()->user() ? 'Admin' : '' }} Chapters</h1>
            <div>
                @if (auth()->user())
                    <a href="{{ route('chapter.create') }}" class="btn btn-info">
                        New Chapter
                    </a>
                @endif
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
        <div class="card-header card-header-tabs-basic nav" role="tablist">
            <a href="#form_4" class="active" data-toggle="tab" role="tab" aria-controls="form_4" aria-selected="true">Form 4</a>
            <a href="#form_5" data-toggle="tab" role="tab" aria-controls="form_5" aria-selected="false">Form 5</a>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active show fade" id="form_4">
                <div class="row">
                    @if (isset($chapters[4]))
                        @forelse ($chapters[4] as $form_4_chapters)
                            <div class="col-md-3">
                                <div class="card card__course">
                                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student-course.html">
                                            <span class="course__title">Chapter {{ $form_4_chapters->id ?? '' }}</span>
                                            <span class="course__subtitle">{{ $form_4_chapters->name ?? '' }}</span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="mb-2 justify-center">
                                            <strong class="text-truncate-custom">{{ $form_4_chapters->description ?? '' }}</strong><br />
                                        </div>
                                        <div class="d-flex align-items-center">
                                            @if (auth()->user())
                                                <a href="{{ route('chapter.edit', $form_4_chapters->id) }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('chapter.show', $form_4_chapters->id) }}" class="btn btn-primary ml-auto">Go to chapter <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No chapters
                        @endforelse
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="form_5">
                <div class="row">
                    @if (isset($chapters[5]))
                        @forelse ($chapters[5] as $form_5_chapters)
                            <div class="col-md-3">
                                <div class="card card__course">
                                    <div
                                        class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column"
                                            href="student-course.html">
                                            <span class="course__title">Chapter {{ $form_5_chapters->id ?? '' }}</span>
                                            <span class="course__subtitle">{{ $form_5_chapters->name ?? '' }}</span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="mb-2 justify-center">
                                            <strong class="text-truncate-custom">{{ $form_5_chapters->description ?? '' }}</strong><br />
                                        </div>
                                        <div class="d-flex align-items-center">
                                            @if (auth()->user())
                                                <a href="{{ route('chapter.edit', $form_5_chapters->id) }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('chapter.show', $form_5_chapters->id) }}" class="btn btn-primary ml-auto">Go to chapter <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No chapters
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
