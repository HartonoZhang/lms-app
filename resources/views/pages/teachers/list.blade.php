@extends('layouts.template')

@section('title', 'List Teachers')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">List Teachers</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('teacher-add') }}" class="btn btn-primary">
                New Teacher
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if (count($listTeacher) == 0)
                        there is no teacher
                    @elseif(count($listTeacher) == 1)
                        there is 1 teacher
                    @else
                        there are {{ count($listTeacher) }} teachers
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <table id="tabel-teachers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th>Religion</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listTeacher as $teacher)
                            <tr>
                                <td class="text-truncate">{{ $teacher->user->name }}</td>
                                <td class="text-truncate">{{ $teacher->user->email }}</td>
                                <td>{{ $teacher->profile->phone_number }}</td>
                                <td>{{ $teacher->profile->gender }}</td>
                                <td>{{ $teacher->profile->religion }}</td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a class="btn btn-primary btn-sm rounded-0"
                                                href="{{ route('teacher-detail', $teacher->id) }}" data-placement="top"
                                                title="Detail"><i class="fa fa-search"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="btn btn-success btn-sm rounded-0"
                                                href="{{ route('teacher-edit', $teacher->id) }}" data-placement="top"
                                                title="Edit"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-danger btn-sm rounded-0" data-toggle="modal"
                                                data-target="#modal-delete-{{ $teacher->id }}" data-placement="top"
                                                title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-delete-{{ $teacher->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action={{ route('teacher-delete', $teacher->id) }} method="POST"
                                            enctype="multipart/form-data" data-remote="true">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h4 class="modal-title">Remove Teacher</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to remove this teacher?</p>
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
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
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
            $("#tabel-teachers").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 5
                }],
                "buttons": [
                    "copy",
                    "print",
                    {
                        extend: 'csv',
                        title: "List Teachers"
                    },
                    {
                        extend: 'excel',
                        title: "List Teachers"
                    }
                ]
            }).buttons().container().appendTo('#tabel-teachers_wrapper .col-md-6:eq(0)');

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
