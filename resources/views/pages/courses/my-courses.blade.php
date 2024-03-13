@extends('layouts.template')

@section('title', 'Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row row-cols-xl-4 row-cols-3">
            @for ($i=0;$i<5;$i++)
                <div class="px-3">
                    <a href="{{route('teacher-course-detail', ['id' => 1])}}">
                        <div class="courses-card card overflow-hidden">
                            <div class="courses-card-users-icon p-1" style="font-size: 0.7rem"><i class="fa fa-user mx-1" aria-hidden="true"></i>67</div>
                            <img loading="lazy" class="courses-card-img card-img-top img-fluid" src="{{url('/assets/img/dummy_course.jpg')}}" alt="course">
                            <div class="courses-card-body card-body py-2 px-2">
                                <div class="">
                                    <div class="" style="font-size: 1rem">Web Prog</div>
                                    <div class="" style="font-size: 0.8rem">COMP0012</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="progress progress-xs rounded w-100">
                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ml-2" style="font-size: 0.8rem">33%</span>
                                </div>
                                <div class="" style="font-size: 0.6rem">3 out of 10 sessions completed</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endfor
            <div class="px-3">
                <a href="{{route('teacher-course-detail', ['id' => 1])}}">
                    <div class="courses-card card overflow-hidden">
                        <div class="courses-card-users-icon p-1" style="font-size: 0.7rem"><i class="fa fa-user mx-1" aria-hidden="true"></i>67</div>
                        <img loading="lazy" class="courses-card-img card-img-top img-fluid" src="{{url('/assets/img/dummy_course.jpg')}}" alt="course">
                        <div class="courses-card-body card-body py-2 px-2">
                            <div class="">
                                <div class="" style="font-size: 1rem">Web Prog</div>
                                <div class="" style="font-size: 0.8rem">COMP0012</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress progress-xs rounded w-100">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-2" style="font-size: 0.8rem">100%</span>
                            </div>
                            <div class="" style="font-size: 0.6rem">10 out of 10 sessions completed</div>
                        </div>
                    </div>
                </a>
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
        }

        .courses-card-body{
            background-color: var(--courseColor);
            color: white;
        }

        .courses-card {
            position: relative;
        }

        .courses-card-img {
            width: 100%;
            max-height: 8rem;
        }

        .courses-card-users-icon {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--courseColor);
            color: white;
            border-bottom-left-radius: 0.5rem;
        }

        .courses-card:hover {
            transition: transform 0.3s;
            transform: scale(1.05);
        }

        .courses-card:not(:hover) {
            transition: transform 0.3s;
            transform: scale(1);
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
        })
    </script>
@endsection
