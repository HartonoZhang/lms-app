@extends('layouts.template')

@section('title', 'Course Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-courses') }}">Courses</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card course-detail-card overflow-hidden">
            <div class="course-detail-header px-4 pt-4 pb-2 d-flex flex-column justify-content-between">
                <div class="">
                    <h3>Web Prog</h3>
                    <div class="mb-2">COMP0012</div>
                    <div class="course-teacher-profile d-flex align-items-center" style="font-size: 0.8rem">
                        <div>
                            <img src="{{url('/assets/img/dummy_course.jpg')}}" alt="Teacher">
                        </div>
                        <div class="ml-2">
                            <p class="m-0">Kenneth Vincent Kwan, S.Kom., M.TI</p>
                            <p class="m-0">D1234 - Primary Instructor</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="progress progress-xs rounded w-100">
                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemax="100"></div>
                    </div>
                    <span class="ml-2" style="font-size: 0.8rem">33%</span>
                </div>
                <div class="mt-3 mb-2 mx-0 px-0">
                    <a class="content-link mr-2 py-1 px-3 active" href="">Sessions</a>
                    <a class="content-link mr-2 py-1 px-3" href="">Assignments</a>
                    <a class="content-link mr-2 py-1 px-3" href="">People</a>
                </div>
            </div>
            <div class="card-body course-detail-body py-2 px-2">
                <div class="row h-100">
                    <div class="col-4 canvas-wrapper">
                        <canvas id="session-roadmap" width="100" height="100"></canvas>
                    </div>
                    <div class="col-8 px-3">
                        <nav>
                            <div class="nav nav-tabs" role="tablist">
                                <button class="nav-link active" data-toggle="tab" data-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Description</button>
                                <button class="nav-link" data-toggle="tab" data-target="#nav-learning-material" type="button" role="tab" aria-controls="nav-learning-material" aria-selected="false">Learning Material</button>
                                <button class="nav-link" data-toggle="tab" data-target="#nav-forum" type="button" role="tab" aria-controls="nav-forum" aria-selected="false">Forum</button>
                                <button class="nav-link" data-toggle="tab" data-target="#nav-attendance" type="button" role="tab" aria-controls="nav-attendance" aria-selected="false">Attendance</button>
                            </div>
                        </nav>
                        <h3 class="my-2 pb-2">
                            {{-- isi custom content --}}
                            Session 1
                        </h3>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                                {{-- isi custom content --}}
                                Disini kita belajar membuat web laravel.
                                <br>
                                Learning points:
                                <ul>
                                    <li>pintar</li>
                                    <li>hebat</li>
                                    <li>sukses</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="nav-learning-material" role="tabpanel" aria-labelledby="nav-learning-material-tab">
                                {{-- isi custom content --}}
                                <div class="row">
                                    @for ($i=0;$i<4;$i++)
                                        <div class="col-6 py-2">
                                            <a class="row" href="#">
                                                <div class="col-4">
                                                    <div class="link-icon-container">
                                                        <i class="fas fa-link"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8 d-flex justify-content-center align-items-center">
                                                    <p class="p-0 m-0">Learning material 1</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endfor
                                    <div class="col-6 py-2">
                                        <a class="row" href="#">
                                            <div class="col-4">
                                                <div class="link-icon-container">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                            </div>
                                            <div class="col-8 d-flex justify-content-center align-items-center">
                                                <p class="p-0 m-0">Learning material 1</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-forum" role="tabpanel" aria-labelledby="nav-forum-tab">
                                {{-- isi custom content --}}
                            </div>
                            <div class="tab-pane fade" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab">
                                {{-- isi custom content --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        /* .select2-container--bootstrap4.select2-container--focus .select2-selection {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection {
            -webkit-transition: none !important;
        }
        label {
            font-weight: 400 !important;
        } */

        :root {
            --courseColor: #1F2B37;
            --courseHeaderGradient1: rgba(0, 0, 0, 0.8);
            --courseHeaderGradient2: rgba(31, 43, 55, 0.8);
        }

        .course-teacher-profile{
            width: 40%;
        }

        .course-teacher-profile img{
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            overflow: hidden;
            object-fit: cover;
        }

        .course-detail-header{
            color: white;
            width: 100%;
            background-image: linear-gradient(var(--courseHeaderGradient1), var(--courseHeaderGradient2)), url('/assets/img/dummy_course.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .content-link.active{
            background-color: rgb(115, 128, 236, 0.8);
            border: 1px solid var(--color-primary-variant);
            color: white;
        }

        .content-link{
            background-color: rgb(125, 141, 161, 0.7);
            border: 1px solid rgb(125, 141, 161, 0.7);
            color: white;
            border-radius: 10rem;
            transition: 0.3s;
        }

        .content-link:not(.active):hover{
            background-color: var(--color-info-dark);
            border: 1px solid var(--color-info-dark);
            color: white;
            transition: 0.3s;
        }

        .course-detail-body{
            height: 40rem;
        }

        .course-detail-body .nav-link{
            background-color: transparent;
            transition: 0.3s;
        }

        .course-detail-body .nav-link.active{
            color: var(--color-primary);
            border-top: 1px solid var(--color-primary);
        }

        .canvas-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        canvas{
            background-color: black;
            position: absolute;
            top: 0;
            left: 0;
        }

        .link-icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 3rem;
            height: 3rem;
            border: 2px solid rgb(128, 128, 128, 0.5);
            border-radius: 50%;
            background-color: var(--color-background);
            margin: auto;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('select').select2({
                theme: 'bootstrap4',
            });

            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif

            makeCanvas()
        })

        function calcXY(coordinate, div){
            return coordinate/div;
        }

        function drawLevel(ctx, x, y, level) {
            ctx.fillStyle = '#FFD700';
            ctx.beginPath();
            ctx.arc(x, y, 20, 0, Math.PI * 2, true);
            ctx.fill();

            ctx.fillStyle = '#FFFFFF';
            ctx.font = '18px Arial';
            ctx.fillText(level, x - ctx.measureText(level).width / 2, y + 6);
        }

        function makeCanvas() {
            const canvas = document.getElementById('session-roadmap');
            const ctx = canvas.getContext('2d');
            const width = canvas.parentElement.clientWidth;
            const height = canvas.parentElement.clientHeight;
            const centerX = calcXY(width,2);
            canvas.width = width;
            canvas.height = height;

            ctx.clearRect(0, 0, width, height);

            ctx.strokeStyle = '#B89777';
            ctx.lineWidth = 12;

            ctx.beginPath();
            ctx.moveTo(centerX, 0);
            ctx.quadraticCurveTo(calcXY(width,3), calcXY(height,11), calcXY(width,3), calcXY(height,6));
            ctx.quadraticCurveTo(calcXY(width,3), calcXY(height,3), calcXY(width,1.5), calcXY(height,3));
            ctx.stroke();

            drawLevel(ctx, 156, 550, '1');
            drawLevel(ctx, 56, 450, '2');
            drawLevel(ctx, 156, 350, '3');
            drawLevel(ctx, 56, 250, '4');
        }

        $(window).resize(function() {
            makeCanvas();
        });
    </script>
@endsection
