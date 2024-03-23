@extends('layouts.template')

@section('title', 'Courses Detail - Assignment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Assignment</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.student.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        Assignment
    </div>
@endsection



@section('css-link')
    <style>

    </style>
@endsection

@section('js-script')

    <script type="text/javascript">
        $(function() {
           
        })
    </script>
@endsection
