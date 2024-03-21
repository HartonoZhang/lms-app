@extends('layouts.template')

@section('title', 'Report Post Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('post-list') }}">List Posts</a></li>
    <li class="breadcrumb-item"><a href="{{ route('post-report-view') }}">List Report Posts</a></li>
    <li class="breadcrumb-item active">Report Post Detail {{ $post->id }}</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card post">
            <div class="card-header pb-0">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm"
                        src="{{ asset('assets') }}/images/profile/{{ $post->user->image }}" alt="user image">
                    <span class="username">
                        <div class="d-flex align-items-center">
                            @if ($post->user->role_id === 2)
                                <a href="/teacher/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                                <span class="badge text-white ml-1" style="background-color: #ffbb55">Teacher</span>
                            @elseif ($post->user->role_id === 3)
                                <a href="/student/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                                <span class="badge text-white ml-1" style="background-color: #7380ec">Student</span>
                            @else
                                {{ $post->user->name }} <span class="badge text-white ml-1"
                                    style="background-color: #f3797e">Admin</span>
                            @endif
                        </div>
                    </span>
                    <span class="description">{{ $post->created_at->format('g:i A d-m-y') }}</span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-2">{{ $post->title }}</h5>
                <div class="row mb-2">
                    @if ($post->image)
                        <div class="image-area col-md-6">
                            <img src="{{ asset('assets') }}/images/posts/image/{{ $post->image }}" alt="image-1"
                                class="img-fluid">
                        </div>
                    @endif
                    @if ($post->image_2)
                        <div class="image-area col-md-6">
                            <img src="{{ asset('assets') }}/images/posts/image_2/{{ $post->image_2 }}" alt="image-2"
                                class="img-fluid">
                        </div>
                    @endif
                </div>
                <p class="card-text">{{ $post->description }}</p>
                @if ($post->link || $post->link_2)
                    <p class="card-text">
                        @if ($post->link)
                            <a href="{{ $post->link }}" target="_blank">{{ $post->link }}</a> <br>
                        @endif
                        @if ($post->link_2)
                            <a href="{{ $post->link_2 }}" target="_blank">{{ $post->link_2 }}</a>
                        @endif
                    </p>
                @endif
                @if ($post->file)
                    <p class="card-text">
                        <a href="{{ asset('assets/images/posts/file') }}/{{ $post->file }}"
                            target="_blank">{{ $post->file }}</a>
                    </p>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if (count($listReportDetail) == 0)
                        there is no report
                    @elseif(count($listReportDetail) == 1)
                        there is 1 report
                    @else
                        there are {{ count($listReportDetail) }} reports
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <table id="tabel-reports" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date Report</th>
                            <th>Name</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listReportDetail as $item)
                            <tr>
                                <td>{{ $item->created_at->format('g:iA, d-m-y') }}</td>
                                <td class="text-truncate">{{ $item->user->name }}</td>
                                <td>{{ $item->report }}</td>
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
        .card-body .card-title {
            font-weight: 600;
        }

        .card-text {
            font-size: 0.87rem !important;
        }

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
            $("#tabel-reports").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false
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
