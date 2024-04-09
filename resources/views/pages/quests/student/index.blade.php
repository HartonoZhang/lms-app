@extends('layouts.template')

@section('title', 'Daily Quest')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Daily Quest</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @php
            $totalCorrect = 0;
            $totalWrong = 0;
            foreach ($answerData as $answer) {
                if ($answer->questStudentAnswer[0]->status === 'Correct') {
                    $totalCorrect += 1;
                }
                if ($answer->questStudentAnswer[0]->status === 'Wrong') {
                    $totalWrong += 1;
                }
            }
        @endphp
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-primary card-outline">
                    <div class="d-flex flex-column text-center py-2">
                        <span style="font-size: 1.2rem;">Total Question</span>
                        <span class="font-weight-bold" style="font-size: 1.5rem;">{{ count($listQuestion) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-success card-outline">
                    <div class="d-flex flex-column text-center py-2">
                        <span style="font-size: 1.2rem;">Answer Correct</span>
                        <span class="font-weight-bold" style="font-size: 1.5rem;">{{ $totalCorrect }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-danger card-outline">
                    <div class="d-flex flex-column text-center py-2">
                        <span style="font-size: 1.2rem;">Answer Wrong</span>
                        <span class="font-weight-bold" style="font-size: 1.5rem;">{{ $totalWrong }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Question</h3>
            </div>
            <div class="card-body">
                <table id="tabel-question" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Created Date</th>
                            <th>Course</th>
                            <th>Question</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listQuestion as $question)
                            @php
                                $done = 0;
                                $status = '';
                                foreach ($question->questStudentAnswer as $student) {
                                    if ($student->student_id === $studentData->id) {
                                        $done = 1;
                                        $status = $student->status;
                                    }
                                }
                            @endphp
                            <tr>
                                <td>
                                    {{ $question->created_at->format('d-m-y, g:i A') }}
                                </td>
                                <td>{{ $question->course->name }}</td>
                                <td class="text-truncate">{{ $question->question }}</td>
                                <td>
                                    @if ($done)
                                        @if ($status === 'Correct')
                                            <span class="badge badge-success">{{ $status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $status }}</span>
                                        @endif
                                    @else
                                        <span class="badge badge-secondary">Not Submitted</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="list-inline m-0">
                                        @if (!$done)
                                            <li class="list-inline-item">
                                                <a href="{{ route('student-do-quest', $question->id) }}"
                                                    class="btn btn-info btn-sm rounded-0" data-placement="top"
                                                    title="Detail">
                                                    <i class="fas fa-question-circle"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="list-inline-item">
                                                <a href="{{ route('quest-answer-result', $question->id) }}"
                                                    class="btn btn-primary btn-sm rounded-0" data-placement="top"
                                                    title="Detail">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
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
    <!-- DataTables -->
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

    <script>
        $(function() {
            $("#tabel-question").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 4
                }]
            }).buttons().container().appendTo('#tabel-question_wrapper .col-md-6:eq(0)');

            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif
        });
    </script>
@endsection
