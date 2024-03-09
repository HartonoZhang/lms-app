@extends('layouts.template')

@section('title', 'Add Classes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Add Classes</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Class Information
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="/admin/add-student" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="firstName" class="form-control form-control-mb"
                                    placeholder="First Name" />
                                <label for="firstName">Class Code*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" />
                                <label for="lastName">Class Name*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="phoneNumber" class="form-control form-control-mb"
                                    placeholder="Phone Number" />
                                <label for="phoneNumber">Minimun Score*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="gender">
                                    <option disabled selected>Select a course</option>
                                    <option value=''>Laki laki
                                    </option>
                                    <option value=''>Perempuan
                                    </option>
                                </select>
                                <label for="inputGender">Course*</label>
                            </div>
                        </div>
                    </div>
                    
                            <div class="card border">
                                <div class="card-body">
                                    <table id="tabel-students" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>test</td>
                                                <td>test</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="3">
                                                        <label class="custom-control-label" for="3"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>test</td>
                                                <td>test</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="2">
                                                        <label class="custom-control-label" for="2"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-body">
                                    <table id="tabel-teachers" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>test</td>
                                                <td>test</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>test</td>
                                                <td>test</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="tes">
                                                        <label class="custom-control-label" for="tes"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                      
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .table {
            table-layout: fixed;
        }

        .select2-container--bootstrap4.select2-container--focus .select2-selection {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection {
            -webkit-transition: none !important;
        }

        label {
            font-weight: 400 !important;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
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
        $(function() {
            $('select').select2({
                theme: 'bootstrap4',
            });

            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif

            $("#tabel-students").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 5,
                "columnDefs": [{
                    orderable: false,
                    targets: 2
                }],
                "buttons": [{
                    extend: 'spacer',
                    text: 'Add Students'
                }]
            }).buttons().container().appendTo('#tabel-students_wrapper .col-md-6:eq(0)');

            $("#tabel-teachers").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 5,
                "columnDefs": [{
                    orderable: false,
                    targets: 2
                }],
                "buttons": [{
                    extend: 'spacer',
                    text: 'Add Teachers'
                }]
            }).buttons().container().appendTo('#tabel-teachers_wrapper .col-md-6:eq(0)');
        })
    </script>
@endsection
