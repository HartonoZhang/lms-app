@extends('layouts.template')

@section('title', 'List Students')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">List Teachers</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('student-add') }}" class="btn btn-success">
                New Teacher
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{-- @if (count($listTask) == 1)
                        there is 1 task
                    @else
                        there are {{ count($listTask) }} tasks
                    @endif --}}
                    there is 1 teacher
                </h3>
            </div>
            <div class="card-body">
                <table id="tabel-teachers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Progress</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-truncate">tes</td>
                            <td class="text-truncate">test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item">
                                        <button class="btn btn-success btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-truncate">tes</td>
                            <td class="text-truncate">test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item">
                                        <button class="btn btn-success btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        {{-- @foreach ($listTask as $item)
                            <tr>
                                <td class="text-truncate">{{ $item->title }}</td>
                                <td class="text-truncate">{{ $item->description }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->progress->name }}</td>
                                <td>{{ $item->priority->name }}</td>
                                <td>{{ $item->deadline ? date('d-M-Y', strtotime($item->deadline)) : 'There is no deadline' }}
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
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
                    targets: 6
                }],
                "buttons": [
                    "copy",
                    {
                        extend: 'csv',
                        title: "List Teachers"
                    },
                    {
                        extend: 'excel',
                        title: "List Teachers"
                    },
                    "print"
                ]
            }).buttons().container().appendTo('#tabel-students_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
