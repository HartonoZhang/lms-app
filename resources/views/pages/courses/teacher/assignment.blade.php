@extends('layouts.template')

@section('title', 'Courses Detail - Assignment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Assignment</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary mb-2" href="{{ route('create-task', $classroom->id) }}">Create Assigment</a>
        </div>
        @include('pages.courses.teacher.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="pill">Assignment</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane show fade" id="list">
                        @if (count($classroom->tasks))
                            <div class="row">
                                @foreach ($classroom->tasks as $task)
                                    <a href="{{ route('task-detail', ['classroom' => $classroom->id, 'task' => $task->id]) }}"
                                        class="col-md-4">
                                        <div class="classroom-task">
                                            <div class="card card-primary card-outline">
                                                <h6 class="card-header text-truncate">{{ $task->title }}</h6>
                                                <div class="card-body">
                                                    <p class="card-text" style="font-size: 0.87rem;">
                                                        {{ $task->description }}
                                                    </p>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="badge badge-primary mr-2">{{ $task->category->name }}</span>
                                                        <small class="ml-auto">Deadline:
                                                            {{ $task->deadline->format('d-m-y, g:i A') }} </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <img src="{{ asset('assets') }}/images/icons/no-data.png" alt="no-data">
                                <p>There are no assignment yet!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <style>
        .classroom-task .card:hover {
            transform: scale(1.04);
            transition: 0.2s ease-in-out;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
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
