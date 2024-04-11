@extends('layouts.template')

@section('title', 'Daily Quest')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Daily Quest</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('create-question') }}" class="btn btn-primary">
                Create Question
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My List Question</h3>
            </div>
            <div class="card-body">
                <table id="tabel-question" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Created Date</th>
                            <th>Course</th>
                            <th>Question</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listQuestion as $question)
                            <tr>
                                <td>{{ $question->created_at->format('d-m-y, g:i A') }}</td>
                                <td>{{$question->course->code == null ? "" : $question->course->code." - "}}{{$question->course->name}}</td>
                                <td class="text-truncate">{{ $question->question }}</td>
                                <td>
                                    <li class="list-inline-item">
                                        <a class="btn btn-success btn-sm rounded-0"
                                            href="{{ route('update-question', $question->id) }}" type="button"
                                            data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-danger btn-sm rounded-0" data-toggle="modal"
                                            data-target="#modal-delete-{{ $question->id }}" data-placement="top"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </li>
                                </td>
                                <div class="modal fade" id="modal-delete-{{ $question->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action={{ route('delete-question', $question->id) }} method="POST"
                                                enctype="multipart/form-data" data-remote="true">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Remove Question</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure want to remove this question?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                    targets: 2
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
