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
                                                <div class="d-flex justify-content-end">
                                                    <button data-toggle="modal" data-target="#add-thread-modal"
                                                        data-sessionId="{{ $item->id }}"
                                                        class="btn btn-primary mb-2">Add Thread</button>
                                                </div>
                                                @if (count($item->threads))
                                                    @foreach ($item->threads as $thread)
                                                        <a href="{{ route('thread-detail', $thread->id) }}">
                                                            <div class="card border">
                                                                <div class="card-header pl-3 pt-2">
                                                                    <div class="d-flex justify-content-between ">
                                                                        <div class="d-flex flex-column ">
                                                                            <div class="user-block">
                                                                                <img loading="lazy" class="img-circle"
                                                                                    src="{{ url('/assets/images/profile/') }}/{{ $thread->user->image }}"
                                                                                    alt="User Image">
                                                                                <span
                                                                                    class="username fw-normal">{{ $thread->user->name }}</span>
                                                                                <span
                                                                                    class="description">{{ $thread->created_at->format('g:iA, d-m-y') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="float-right text-muted"
                                                                            style="font-size: 0.85rem;">{{ count($thread->comments) }}
                                                                            comments</span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="my-0">{{ $thread->title }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <div class="text-center">There are no forum yet</div>
                                                @endif
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

    <div class="modal fade" id="add-thread-modal" tabindex="-1" role="dialog" aria-labelledby="add-thread-modal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Thread</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('thread-post') }}">
                        @csrf
                        <input type="text" class="form-control" name="sessionId" id="threadSessionIdInput"
                            value="{{ old('sessionId') }}" hidden>
                        <div class="form-group" data-input="title">
                            <label for="threadTitle">Title</label>
                            <input type="text" class="form-control" name="title" id="threadTitle"
                                placeholder="Thread Title" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" data-input="description">
                            <label for="threadDescription">Description</label>
                            <textarea type="text" class="form-control" name="description" id="threadDescription"
                                placeholder="Thread Description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Post Thread</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

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
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#carouselExampleCaptions').on('slid.bs.carousel', function(e) {
                var ele = $('#carouselExampleCaptions .carousel-indicators li.active');
                var $sessions = $('#sessionText');
                $sessions.text(`Session ${ele.data('slideTo') + 1}`);
            })

            $('*[data-target="#add-thread-modal"]').click(function() {
                var sessionId = $(this).attr('data-sessionId');
                $("#threadSessionIdInput").val(sessionId);
            });

            @if ($errors->any())
                @if (Session::has('failPostThread'))
                    $('#add-thread-modal').modal('show');
                @endif
            @endif

            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif
        })
    </script>
@endsection
