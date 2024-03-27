@extends('layouts.template')

@section('title', 'Update Score')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course-detail-score', $classroom->id) }}">Courses Detail</a></li>
    <li class="breadcrumb-item active">Update Score</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Student Score Information ({{ $studentScore->student->user->name }})
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal"
                    action={{ route('student-score-update', ['classroom' => $classroom->id, 'student' => $studentScore->student->id]) }}
                    method="POST" enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Assignment" name="asg" value="{{ old('asg', $studentScore->asg) }}" />
                                <label for="asg">Assignment*</label>
                            </div>
                            @error('asg')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Project" name="project" value="{{ old('project', $studentScore->project) }}" />
                                <label for="project">Project*</label>
                            </div>
                            @error('project')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Exam" name="exam" value="{{ old('exam', $studentScore->exam) }}" />
                                <label for="asg">Exam*</label>
                            </div>
                            @error('exam')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('teacher-course-detail-score', $classroom->id) }}"
                        class="btn btn-secondary mt-3">Back</a>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    @endsection

    @section('css-link')
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">=

        <style>
            label {
                font-weight: 400 !important;
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
