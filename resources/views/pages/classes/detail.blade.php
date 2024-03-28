@extends('layouts.template')

@section('title', 'Detail Class')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Detail Class</li>
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
                <div class="form-row">
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="classCode" class="form-control form-control-mb {{$data->code ? "" : "font-italic"}}"
                                placeholder="Class Code" name="code" value="{{$data->code ? $data->code : "No code"}}" disabled />
                            <label for="Class Code">Class Code*</label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="className" class="form-control form-control-mb"
                                placeholder="Class Name" name="name" value="{{$data->name}}" disabled/>
                            <label for="Class Name">Class Name*</label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="maxCapacity" class="form-control form-control-mb {{$data->student_capacity ? "" : "font-italic"}}"
                                placeholder="Max capacity for student" value="{{$data->student_capacity ? $data->student_capacity : "No limit"}}" disabled/>
                            <label for="Max capacity for student">Max capacity for student*</label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="minScore" class="form-control form-control-mb"
                                placeholder="Minimum score" name="min_score" value="{{$data->min_score}}" disabled/>
                            <label for="minScore">Minimum score to pass*</label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="course" class="form-control form-control-mb"
                                placeholder="Course" value="{{$data->course->code == null ? "" : $data->course->code." - "}}{{$data->course->name}}" disabled/>
                            <label for="Course">Course*</label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="period" class="form-control form-control-mb"
                                placeholder="Period" value="{{$data->period->name}}" disabled/>
                            <label for="Period">Period*</label>
                        </div>
                    </div>
                </div>
                <h3 class="card-title">
                    Task percentage score
                </h3>
                <br>
                <div class="form-row mt-3">
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="asg" class="form-control form-control-mb"
                                placeholder="Assignment" name="asg" value="{{$data->asg}}" disabled />
                            <label for="asg">Assignment*</label>
                        </div> 
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="exam" class="form-control form-control-mb"
                                placeholder="Exam" name="exam" value="{{$data->exam}}" disabled />
                            <label for="exam">Exam*</label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="project" class="form-control form-control-mb"
                                placeholder="Project" name="project" value="{{$data->project}}" disabled />
                            <label for="project">Project*</label>
                        </div>
                    </div>
                </div>
                <div class="card border">
                    <div class="card-body">
                        <table id="table-students" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentLists as $student)
                                    <tr>
                                        <td>{{$student->user->name}}</td>
                                        <td>{{$student->user->email}}</td>
                                        <td>
                                            <a href={{route('student-detail',$student->id)}} class="btn btn-primary btn-sm rounded-0"  type="button"
                                                data-toggle="tooltip" data-placement="top" title="Detail">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card border">
                    <div class="card-body">
                        <table id="table-teachers" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teacherLists as $teacher)
                                    <tr>
                                        <td>{{$teacher->user->name}}</td>
                                        <td>{{$teacher->user->email}}</td>
                                        <td>
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item">
                                                    <a href={{route('teacher-detail',$teacher->id)}} class="btn btn-primary btn-sm rounded-0"  type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <a type="button" href={{route('class-list')}} class="btn btn-secondary">Back</a>
                <a type="button" href={{route('class-update',$data->id)}} class="btn btn-primary">Edit this classroom</a>
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

            $("#table-students").DataTable({
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
                    text: 'Student list in this classroom'
                }]
            }).buttons().container().appendTo('#table-students_wrapper .col-md-6:eq(0)');

            $("#table-teachers").DataTable({
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
                    text: 'Teacher list in this classroom'
                }]
            }).buttons().container().appendTo('#table-teachers_wrapper .col-md-6:eq(0)'); 

        })
    </script>
@endsection
