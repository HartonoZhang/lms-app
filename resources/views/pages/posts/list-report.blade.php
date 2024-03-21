@extends('layouts.template')

@section('title', 'List Report Posts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('post-list') }}">List Posts</a></li>
    <li class="breadcrumb-item active">List Report Posts</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('post-list') }}" class="btn btn-primary">
                View Posts
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if (count($listReport) == 0)
                        there is no report
                    @elseif(count($listReport) == 1)
                        there is 1 report
                    @else
                        there are {{ count($listReport) }} reports
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <table id="tabel-reports" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date Post</th>
                            <th>Title Post</th>
                            <th>Total Report</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPostWithReport as $item)
                            @if (count($item->report))
                                <tr>
                                    <td>{{ $item->created_at->format('d-m-y') }}</td>
                                    <td class="text-truncate">{{ $item->title }}</td>
                                    <td>{{ count($item->report) }}</td>
                                    <td>
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <a class="btn btn-primary btn-sm rounded-0"
                                                    href="{{ route('post-report-detail', $item->id) }}" data-placement="top"
                                                    title="Detail"><i class="fa fa-search"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" class="btn btn-danger btn-sm rounded-0"
                                                    data-toggle="modal" data-target="#modal-delete-{{ $item->id }}"
                                                    data-placement="top" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-delete-{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action={{ route('post-delete', $item->id) }} method="POST"
                                                enctype="multipart/form-data" data-remote="true">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Remove Post</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure want to remove "{{ $item->title }}" post?</p>
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
                            @endif
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
            $("#tabel-reports").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 3
                }],
                "buttons": [
                    "copy",
                    "print",
                    {
                        extend: 'csv',
                        title: "List Reports",
                    },
                    {
                        extend: 'excel',
                        title: "List Reports"
                    }
                ]
            }).buttons().container().appendTo('#tabel-reports_wrapper .col-md-6:eq(0)');

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
