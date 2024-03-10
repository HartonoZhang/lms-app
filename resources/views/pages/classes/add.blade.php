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
                <form class="form-horizontal" action="{{route('class-add')}}" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="firstName" class="form-control form-control-mb"
                                    placeholder="First Name" name="code" value="{{old("code")}}" />
                                <label for="firstName">Class Code*</label>
                            </div>
                            @error('code')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" name="name" value="{{old("name")}}" />
                                <label for="lastName">Class Name*</label>
                            </div>
                            @error('name')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" name="student_capacity" value="{{old("student_capacity")}}" />
                                <label for="lastName">Max capacity for student (leave empty value if no limit)*</label>
                            </div>
                            @error('student_capacity')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="course">
                                    <option disabled selected>Select a course</option>
                                    @foreach ($courses as $course)
                                        <option value={{$course->id}} {{old('course') == $course->id ? "selected" : ""}}>{{$course->code == null ? "" : $course->code." - "}}{{$course->name}}</option>
                                    @endforeach
                                </select>
                                <label for="inputGender">Course*</label>
                            </div>
                            @error('course')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <table id="tabel-students" class="table table-bordered table-striped">
                                <thead>
                                    @error('students')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                    @enderror   
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->user->email}}</td>
                                            <td>
                                                @php
                                                    $isCheckedBefore = false;
                                                    if(old('students')){
                                                        if(in_array($student->id,old('students'))){
                                                            $isCheckedBefore = true;
                                                        }
                                                    }
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="students[]" value="{{$student->id}}" id="studentid-{{$student->id}}" {{$isCheckedBefore ? "checked" : ""}} >
                                                    <label class="custom-control-label" for="studentid-{{$student->id}}"></label>
                                                </div>
                                            </td>
                                        </tr>    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <table id="tabel-teachers" class="table table-bordered table-striped">
                                <thead>
                                    @error('teachers')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                    @enderror   
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->user->email}}</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="teachers[]" value="{{$teacher->id}}" id="teacherid-{{$teacher->id}}">
                                                    <label class="custom-control-label" for="teacherid-{{$teacher->id}}"></label>
                                                </div>
                                            </td>
                                        </tr>    
                                    @endforeach
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
                    'orderable': false,
                    'targets': 2,
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
                    targets: 2,
                }],
                "buttons": [{
                    extend: 'spacer',
                    text: 'Add Teachers'
                }]
            }).buttons().container().appendTo('#tabel-teachers_wrapper .col-md-6:eq(0)');
        })
    </script>
@endsection
