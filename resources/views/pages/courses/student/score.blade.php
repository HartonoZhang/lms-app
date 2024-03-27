@extends('layouts.template')

@section('title', 'Courses Detail - Score')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Score</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.student.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        <div class="card">
            <div class="card-header mx-auto">
                <h3 class="card-title font-weight-bold">
                    Your Score
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card card-primary card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Assignment (30%)</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">34</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card card-warning card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Project (30%)</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">34</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card card-info card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Exam (30%)</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">34</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-danger card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Minimun Score</span>
                                <span class="font-weight-bold" style="font-size: 1.5rem;">34</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="d-flex flex-column text-center py-2">
                                <span style="font-size: 1.2rem;">Your Total Score</span>
                                <div class="d-flex mx-auto align-items-center">
                                    <span class="font-weight-bold" style="font-size: 1.5rem;">34 </span>
                                    <span class="badge badge-success ml-2">Passed</span>
                                    <span class="badge badge-danger ml-2">Failed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .table {
            table-layout: fixed;
        }
    </style>
@endsection

@section('js-script')
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

    <script>
        $(function() {
            $("#tabel-score").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 4
                }],
            }).buttons().container().appendTo('#tabel-attendances_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
