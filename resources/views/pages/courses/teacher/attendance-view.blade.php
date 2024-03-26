@extends('layouts.template')

@section('title', 'Attendance View')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}/course">My Courses</a></li>
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}/course/{{$classroom->id}}">Courses Detail</a></li>
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}/course/{{$classroom->id}}/attendance">Attendance</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="">
            <form id="attendance-filter-form" action="{{route('teacher-course-detail-attendance-view', ['id' => $classroom->id, 'sessionId' => $session->id])}}" method="GET">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="form-group col-md-6 my-1" data-input="name">
                                <input type="text" name="name" class="mx-1 form-control"
                                    placeholder="Search Student Name..." value="{{session('attendance_name', '')}}" />
                                <span class="text-danger attendance-filter-error"></span>
                            </div>
                            <div class="form-group col-md-6 my-1" data-input="studentId">
                                <input type="text" name="studentId" class="mx-1 form-control"
                                    placeholder="Search Student Id..." value="{{session('attendance_studentId', '')}}" />
                                <span class="text-danger attendance-filter-error"></span>
                            </div>
                            <div class="form-group col-md-12 my-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="attendanceFilter" id="filterAll" value="all"
                                        {{(session('attendance_filter', '') == 'all' || session('attendance_filter', '') === null)
                                         ? 'checked' : ''}}>
                                    <label class="form-check-label" for="filterAll">All</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="attendanceFilter" id="filterPresent" value="present" {{session('attendance_filter', '') == 'present' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="filterPresent">Present</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="attendanceFilter" id="filterNotPresent" value="notPresent" {{session('attendance_filter', '') == 'notPresent' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="filterNotPresent">Not
                                        Present</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 my-1">
                        <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <form id="attendance-list-form" action="{{route('teacher-course-detail-attendance-save', ['id' => $classroom->id, 'sessionId' => $session->id])}}" method="POST">
                @csrf
                <div class="attendance-list">
                    <div class="row">
                        @foreach ($listStudent as $st)
                            <div class="col-md-6 my-2">
                                <div class="card m-0">
                                    <div class="student-attendance d-flex align-items-center justify-content-between rounded border p-2">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img loading="lazy" class="img-circle img-sm"
                                                src="{{ url('/assets/images/profile/') . "/{$st->student->user->image}" }}"
                                                alt="User Image">
                                            <div class="ml-2">
                                                <p class="mb-0">{{$st->student->user->name}}</p>
                                                <small class="text-muted">student_id</small>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input p-student" name="present[]"
                                                id="p-student-{{$st->student->id}}" value="{{$st->student->id}}" {{($st->student->attendanceBySession->is_present ?? null) ? 'checked' : ''}}>
                                            <input id="np-student-{{$st->student->id}}" type="text" class="np-student" name="notPresent[]" value="{{$st->student->id}}" {{($st->student->attendanceBySession->is_present ?? null) ? 'disabled' : ''}} hidden>
                                            <label class="custom-control-label"
                                                for="p-student-{{$st->student->id}}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <button type="submit" class="btn btn-primary mb-4">Save</button>
                    {{ $listStudent->appends(['name' => session('attendance_name', ''), 'studentId' => session('attendance_studentId', ''), 'attendanceFilter' => session('attendance_filter', '')])->links() }}
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <style>
        .student-attendance {
            cursor: pointer;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
            @if ($errors->any())
                @if (Session::has('failUpdateThread'))
                    $('#modal-edit').modal('show');
                @endif
            @endif

            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif

            $('.student-attendance').click(function() {
                let element = $(this);
                element.find('.custom-checkbox .p-student').prop('checked', function(i, checked) {
                    if (checked) {
                        element.find('.custom-checkbox .np-student').prop('disabled', false);
                    } else {
                        element.find('.custom-checkbox .np-student').prop('disabled', true);
                    }
                    return !checked;
                });
            });
        })
    </script>
@endsection
