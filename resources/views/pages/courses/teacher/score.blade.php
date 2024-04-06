@extends('layouts.template')

@section('title', 'Courses Detail - Score')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Score</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.teacher.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    List Student Score
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="card card-primary card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Assignment</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">{{ $classroom->asg }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="card card-warning card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Project</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">{{ $classroom->project }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="card card-info card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Exam</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">{{ $classroom->exam }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="card card-warning card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Minimun Score</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">{{ $classroom->min_score }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabel-score" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Total Score</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listStudentScore as $studentScore)
                            <tr>
                                <td>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ url('/assets/images/profile/') }}/{{ $studentScore->student->user->image }}"
                                            alt="user image">
                                        <span class="username text-truncate">
                                            {{ $studentScore->student->user->name }}
                                        </span>
                                        <span class="description text-truncate">
                                            {{ $studentScore->student->user->email }}</span>
                                    </div>
                                </td>
                                @php
                                    if (
                                        $studentScore->asg === null ||
                                        $studentScore->project === null ||
                                        $studentScore->exam === null
                                    ) {
                                        $result = 'N/A';
                                    } else {
                                        $asg = $studentScore->asg * $classroom->asg;
                                        $project = $studentScore->project * $classroom->project;
                                        $exam = $studentScore->exam * $classroom->exam;
                                        $result = ($asg + $project + $exam) / 100;
                                    }
                                @endphp
                                <td>
                                    {{ $result }}
                                </td>
                                <td>
                                    @if ($result === 'N/A')
                                        {{ $result }}
                                    @elseif ($result >= $classroom->min_score)
                                        <span class="badge badge-success">Passed</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm rounded"
                                        href="{{ route('student-score-update', ['classroom' => $classroom->id, 'student' => $studentScore->student->id]) }}">Update</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .classroom-task .card:hover {
            transform: scale(1.04);
            transition: 0.2s ease-in-out;
        }

        .table {
            table-layout: fixed;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script type="text/javascript">
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var fileName = input.files[0].name;
                var infoArea = document.getElementById(`upload-file-${id}`);
                infoArea.textContent = 'File name: ' + fileName;
            }
        }

        $(function() {
            $("#tabel-score").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    'orderable': false,
                    'targets': 3,
                }],
            }).buttons().container().appendTo('#tabel-score_wrapper .col-md-6:eq(0)');

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
