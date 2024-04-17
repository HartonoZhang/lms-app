@extends('layouts.template')

@section('title', 'Courses Detail - People')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - People</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.teacher.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#students" data-toggle="pill">Students</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#teachers" data-toggle="pill">Teacher</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane show fade" id="students">
                        <div class="d-flex flex-wrap border-bottom">
                            @foreach ($listStudent as $student)
                                <div class="col-sm-4">
                                    <a href="/student/profile/{{ $student->student->user->id }}">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('assets') }}/images/profile/{{ $student->student->user->image }}"
                                                alt="User profile picture" style="width: 125px; height: 125px;">
                                        </div>

                                        <p class="text-center mb-0 mt-2" style="font-size: 1rem">
                                            {{ $student->student->user->name }} </p>
                                        <p class="text-center text-muted" style="font-size: 0.8rem">
                                            {{ $student->student->user->email }} </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="float-right mt-2">
                            {{ $listStudent->links() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="teachers">
                        <div class="d-flex flex-wrap border-bottom">
                            @foreach ($teacherClassroom as $teacher)
                                <div class="col-sm-4">
                                    <a href="/teacher/profile/{{ $teacher->teacher->user->id }}">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('assets') }}/images/profile/{{ $teacher->teacher->user->image }}"
                                                alt="User profile picture" style="width: 125px; height: 125px;">
                                        </div>
                                        <p class="text-center mb-0 mt-2" style="font-size: 1rem">
                                            {{ $teacher->teacher->user->name }} </p>
                                        <p class="text-center text-muted" style="font-size: 0.8rem">
                                            {{ $teacher->teacher->user->email }} </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
