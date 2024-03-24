@extends('layouts.template')

@section('title', 'Courses Detail - Sessions')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Sessions</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.student.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        @if (count($sessions))
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="card card-primary card-outline">
                    <div class="card-header mx-auto">
                        <h3 class="card-title font-weight-bold" id="sessionText">Sessions 1</h3>
                    </div>
                    <div class="card-body my-0 py-0">
                        <ol class="carousel-indicators my-0 py-0">
                            @foreach ($sessions as $key => $item)
                                <li data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}"
                                    class="{{ $key === 0 ? 'active' : '' }}">{{ $key + 1 }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div class="carousel-inner">
                    @foreach ($sessions as $key => $item)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="col-md-11 px-0 mx-auto">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active"
                                                    href="#description-{{ $item->id }}"
                                                    data-toggle="pill">Description</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="#learningMaterial-{{ $item->id }}" data-toggle="pill">Learning
                                                    Material</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#forum-{{ $item->id }}"
                                                    data-toggle="pill">Forum</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane show fade" id="description-{{ $item->id }}">
                                                <h3>{{ $item->title }}</h3>
                                                <p class="pb-2 border-bottom" style="font-size: 1.25rem;">
                                                    {{ $item->description }}</p>
                                                <p>Start Time : {{ $item->start_time->format('g:i A, d-m-y') }}</p>
                                                <p>End Time : {{ $item->end_time->format('g:i A, d-m-y') }}</p>
                                                <a href="#" class="btn btn-primary">Join Now</a>
                                            </div>
                                            <div class="tab-pane fade" id="learningMaterial-{{ $item->id }}">
                                                @if (count($item->materials) === 0)
                                                    <p>No have materials</p>
                                                @else
                                                    @foreach ($item->materials as $material)
                                                        <a href="{{ $material->value }}" target="_blank">
                                                            <div class="d-flex align-items-center">
                                                                @if ($material->is_file)
                                                                    <span class="p-2 rounded"
                                                                        style="font-size: 1em; background-color: #7380ec; color: white">
                                                                        <i class="fas fa-file"></i>
                                                                    </span>
                                                                @else
                                                                    <span class="p-2 rounded"
                                                                        style="font-size: 1em; background-color: #7380ec; color: white">
                                                                        <i class="fas fa-external-link-alt"></i>
                                                                    </span>
                                                                @endif
                                                                <span class="ml-2" style="font-size: 0.87rem;">
                                                                    {{ $material->title }}</span>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="forum-{{ $item->id }}">
                                                forum
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev d-lg-flex d-none" type="button" data-target="#carouselExampleCaptions"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next d-lg-flex d-none" type="button" data-target="#carouselExampleCaptions"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        @else
            <div class="card card-primary card-outline">
                <div class="card-header mx-auto">
                    <h3 class="card-title">There no sessions yet</h3>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('css-link')

    <style>
        .carousel-inner {
            padding-bottom: 40px;
        }

        .carousel-indicators {
            position: relative;
        }

        .carousel-control-prev,
        .carousel-control-next {
            height: 40px;
            width: 40px;
            outline: var(--color-primary);
            border-radius: 50%;
            top: 55%;
            border: 1px solid var(--color-primary);
            background-color: var(--color-primary);
            transform: translate(0, -50%);
        }

        .carousel .carousel-indicators li,
        .carousel .carousel-indicators li.active {
            background-color: var(--color-primary);
        }

        .carousel-indicators li {
            border-radius: 50%;
            width: 27px;
            height: 27px;
            text-indent: -1px;
            color: white;
            text-align: center;
        }
    </style>
@endsection

@section('js-script')

    <script type="text/javascript">
        $(function() {
            $('#carouselExampleCaptions').on('slid.bs.carousel', function(e) {
                var ele = $('#carouselExampleCaptions .carousel-indicators li.active');
                var $sessions = $('#sessionText');

                $sessions.text(`Session ${ele.data('slideTo') + 1}`);
            })
        })
    </script>
@endsection
