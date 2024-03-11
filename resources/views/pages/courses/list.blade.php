@extends('layouts.template')

@section('title', 'List Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">List Courses</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('course-add') }}" class="btn btn-primary">
                Add Course
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    There are {{$datas->count()}} courses
                </h3>
            </div>
            <div class="card-body">
                <table id="tabel-courses" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Course name</th>
                            <th>Course code</th>
                            <th>Minimum score required to pass</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td class="text-truncate">{{$data->name}}</td>
                                <td class="text-truncate {{$data->code == null ? "font-italic" : ""}}">
                                    {{$data->code == null ? "No code" : $data->code}}
                                </td>
                                <td>{{$data->min_score}}</td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <button class="btn btn-success btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></button>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-danger btn-sm rounded-0" data-toggle="modal"
                                                data-target="#modal-delete-{{ $data->id }}" data-placement="top" 
                                                title="Delete">
                                                    <i class="fa fa-trash"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            {{-- Modal delete start --}}
                            <div class="modal fade" id="modal-delete-{{ $data->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action={{route('course-delete',$data->id)}} method="POST" enctype="multipart/form-data" data-remote="true">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h4 class="modal-title">Remove Course</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to remove "{{$data->name}}" course?</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal delete end --}}
                        @endforeach
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

     <!-- Toastr -->
     <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
     <link rel="stylesheet" type="text/css"
         href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
 
     <style>
         label {
             font-weight: 400 !important;
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
            $("#tabel-courses").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 3
                }],
                "buttons": [
                    "copy",
                    {
                        extend: 'csv',
                        title: "List Courses"
                    },
                    {
                        extend: 'excel',
                        title: "List Courses"
                    },
                    "print"
                ]
            }).buttons().container().appendTo('#tabel-courses_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
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
