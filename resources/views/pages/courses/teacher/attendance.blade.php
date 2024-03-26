@extends('layouts.template')

@section('title', 'Courses Detail - Attendance')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Attendance</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.teacher.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        <div class="card">
            <div class="card-body">
                <table id="tabel-attendances" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Session</th>
                            <th>Delivery</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $key => $item)
                            <tr>
                                <td>Session {{ $key + 1 }}</td>
                                <td>Virtual</td>
                                <td>{{ $item->start_time->format('g:i A, d-m-y') }}</td>
                                <td>{{ $item->end_time->format('g:i A, d-m-y') }}</td>
                                <td>
                                    {{-- <a class="btn btn-warning" href="{{route('teacher-course-detail-attendance-view', ['id' => $classroom->id, 'sessionId' => $item->id])}}">Edit</a> --}}
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
            $("#tabel-attendances").DataTable({
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
