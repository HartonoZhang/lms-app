@extends('layouts.template')

@section('title', 'Edit Class')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Edit Class</li>
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
                <form class="form-horizontal" id="addClassroomForm" action="{{route('class-update',$data->id)}}" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="firstName" class="form-control form-control-mb"
                                    placeholder="First Name" name="code" value="{{old("code") ? old("code") : $data->code}}" />
                                <label for="firstName">Class Code*</label>
                            </div>
                            @error('code')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" name="name" value="{{old("name") ? old("name") : $data->name}}" />
                                <label for="lastName">Class Name*</label>
                            </div>
                            @error('name')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" name="student_capacity" value="{{old("student_capacity") ? old("student_capacity") : $data->student_capacity}}" />
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
                                        @php
                                            $selected = false;
                                            if (old('course')) {
                                                if(old ('course')== $course->id){
                                                    $selected = true;
                                                }
                                            } else if ($course->id == $data->course_id){
                                                $selected = true;
                                            }
                                        @endphp
                                        <option value={{$course->id}} {{$selected ? "selected" : ""}}>{{$course->code == null ? "" : $course->code." - "}}{{$course->name}}</option>
                                    @endforeach
                                </select>
                                <label for="inputGender">Course*</label>
                            </div>
                            @error('course')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="period">
                                    <option disabled selected>Select period</option>
                                    @foreach ($periods as $period)
                                        @php
                                            $selected = false;
                                            if (old('period')) {
                                                if(old ('period')== $period->id){
                                                    $selected = true;
                                                }
                                            } else if ($period->id == $data->period_id){
                                                $selected = true;
                                            }
                                        @endphp
                                        <option value={{$period->id}} {{$selected ? "selected" : ""}}>{{$period->name}}</option>
                                    @endforeach
                                </select>
                                <label for="inputGender">Period*</label>
                            </div>
                            @error('period')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <h3 class="card-title">
                        Task percentage score (total sum of 3 fields must be 100)
                    </h3>
                    <input type="text" id="taskScore" class="form-control form-control-mb"
                        hidden name="taskScore" value="{{old("taskScore")}}" />
                    <br>
                    @error('taskScore')
                        <p class="text-danger mb-1">{{ $message }}</p>
                    @enderror
                    <div class="form-row mt-3">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="asg" class="form-control form-control-mb"
                                    placeholder="Assignment" name="asg" value="{{old("asg") ? old("asg") : $data->asg}}" />
                                <label for="asg">Assignment*</label>
                            </div>
                            @error('asg')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="exam" class="form-control form-control-mb"
                                    placeholder="Exam" name="exam" value="{{old("exam") ? old("exam") : $data->exam}}" />
                                <label for="exam">Exam*</label>
                            </div>
                            @error('exam')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="project" class="form-control form-control-mb"
                                    placeholder="Project" name="project" value="{{old("project") ? old("project") : $data->project}}" />
                                <label for="project">Project*</label>
                            </div>
                            @error('project')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @php
                        if (old('studentLists')) {
                            $oldCheckedStudent = explode(',',old('studentLists'));
                        }else {
                            $oldCheckedStudent = $checkedStudent;
                        }
                        if (old('teacherLists')) {
                            $oldCheckedTeacher = explode(',',old('teacherLists'));
                        }else {
                            $oldCheckedTeacher = $checkedTeacher;
                        }
                    @endphp
                    <script type="text/javascript">
                        var studentCheckboxes = '<?php echo json_encode($oldCheckedStudent); ?>'
                        if (studentCheckboxes === "null") {
                            studentCheckboxes = []
                        } else {
                            studentCheckboxes = studentCheckboxes.replaceAll("[","").replaceAll("]","").replaceAll("\"","").split(",")
                            studentCheckboxes = studentCheckboxes.map(Number)
                        }
                        console.log(studentCheckboxes)
                        function updateStudentCheckbox(id){
                            if (!studentCheckboxes.includes(id)){
                                studentCheckboxes.push(id);
                            } else {
                                index = studentCheckboxes.indexOf(id);
                                if (index > -1) {
                                    studentCheckboxes.splice(index, 1);
                                }
                            }
                            console.log(studentCheckboxes)
                            document.getElementById("studentLists").value = studentCheckboxes;
                        }
                    </script>
                    <div class="card border">
                        <div class="card-body">
                            <table id="table-students" class="table table-bordered table-striped">
                                <thead>
                                    @error('studentLists')
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
                                            <td>{{$student->user->name}}</td>
                                            <td>{{$student->user->email}}</td>
                                            <td>
                                                @php
                                                    $isChecked = false;
                                                    if ($oldCheckedStudent) {
                                                        if (in_array($student->id, $oldCheckedStudent)){
                                                            $isChecked = true;
                                                        }
                                                    }
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="studentid-{{$student->id}}" 
                                                        onchange=updateStudentCheckbox({{$student->id}}) {{$isChecked ? "checked" : ""}} />
                                                    <label class="custom-control-label" for="studentid-{{$student->id}}"></label>
                                                </div>
                                            </td>
                                        </tr>    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="studentLists"  id="studentLists"/>
                    <script type="text/javascript">
                         var teacherCheckboxes = '<?php echo json_encode($oldCheckedTeacher); ?>'
                        if (teacherCheckboxes === "null") {
                            teacherCheckboxes = []
                        } else {
                            teacherCheckboxes = teacherCheckboxes.replaceAll("[","").replaceAll("]","").replaceAll("\"","").split(",")
                            teacherCheckboxes = teacherCheckboxes.map(Number)
                        }
                        function updateTeacherCheckbox(id){
                            // console.log(id);
                            if (!teacherCheckboxes.includes(id)){
                                teacherCheckboxes.push(id);
                            } else {
                                index = teacherCheckboxes.indexOf(id);
                                if (index > -1) {
                                    teacherCheckboxes.splice(index, 1);
                                }
                            }
                            document.getElementById("teacherLists").value = teacherCheckboxes;
                        }
                    </script>
                    <div class="card border">
                        <div class="card-body">
                            <table id="table-teachers" class="table table-bordered table-striped">
                                <thead>
                                    @error('teacherLists')
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
                                            <td>{{$teacher->user->name}}</td>
                                            <td>{{$teacher->user->email}}</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    @php
                                                        $isChecked = false;
                                                        if ($oldCheckedTeacher) {
                                                            if (in_array($teacher->id, $oldCheckedTeacher)){
                                                                $isChecked = true;
                                                            }
                                                        }
                                                    @endphp
                                                    <input type="checkbox" class="custom-control-input" id="teacherid-{{$teacher->id}}" 
                                                        onchange=updateTeacherCheckbox({{$teacher->id}}) {{$isChecked ? "checked" : ""}} >
                                                    <label class="custom-control-label" for="teacherid-{{$teacher->id}}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="teacherLists"  id="teacherLists"/>
                    <a type="button" href="{{route('class-list')}}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
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

            $("#table-students").DataTable({
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
                    text: 'Add Teachers'
                }]
            }).buttons().container().appendTo('#table-teachers_wrapper .col-md-6:eq(0)'); 
            
            $('#addClassroomForm').on('submit',function (){
                $('#studentLists').val(studentCheckboxes);
                $('#teacherLists').val(teacherCheckboxes);
            })

        })
    </script>
@endsection
