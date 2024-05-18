@extends('layouts.template')

@section('title', 'Courses Detail - Assignment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Assignment</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.student.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#status" data-toggle="pill">List Assignment</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane show fade" id="status">
                        <table id="tabel-assignment" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Type</th>
                                    <th>Deadline</th>
                                    <th>Upload Date</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classroom->tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->category->name }}</td>
                                        <td>{{ $task->deadline->format('g:i A, d-m-y') }}</td>
                                        <td>
                                            @php
                                                $dateUpload = 'Not Submitted';
                                                foreach ($task->uploads as $upload) {
                                                    if ($upload->student->user->id == Auth::user()->id) {
                                                        $dateUpload = $upload->created_at->format('g:i A, d-m-y');
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $dateUpload }}
                                        </td>
                                        <td>
                                            @php
                                                $status = 'Not Submitted';
                                                foreach ($task->uploads as $upload) {
                                                    if ($upload->student->user->id == Auth::user()->id) {
                                                        $status = $upload->status;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $status }}
                                        </td>
                                        <td>
                                            @php
                                                $note = '-';
                                                foreach ($task->uploads as $upload) {
                                                    if ($upload->student->user->id == Auth::user()->id) {
                                                        $note = $upload->note;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $note ? $note : '-' }}
                                        </td>
                                        <td>
                                            @php
                                                $file = '';
                                                $statusUpload = '';
                                                foreach ($task->uploads as $upload) {
                                                    if ($upload->student->user->id == Auth::user()->id) {
                                                        $file = $upload->file_upload;
                                                        $statusUpload = $upload->status;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <ul class="list-inline m-0">
                                                @if ($task->deadline > date('Y-m-d H:i:s') && $statusUpload != 'Done')
                                                    <li class="list-inline-item">
                                                        <a href="#" class="btn btn-primary btn-sm rounded-0"
                                                            data-toggle="modal"
                                                            data-target="#submit-assigment-{{ $task->id }}"
                                                            data-placement="top">
                                                            <i class="fas fa-upload"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li class="list-inline-item">
                                                    @if ($file)
                                                        <a href="{{ asset('assets/tasks/answer') }}/{{ $file }}"
                                                            class="btn btn-info btn-sm rounded-0" target="_blank">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="submit-assigment-{{ $task->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="submit-assigment" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Submit {{ $task->category->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="modal-title">{{ $task->title }}</h5>
                                                    <p class="modal-text mt-2" style="font-size: 0.87rem;">
                                                        {{ $task->description }}</p>
                                                    @if ($task->question_file)
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-file-download mr-2"></i>
                                                            <a href="{{ asset('assets/tasks/question') }}/{{ $task->question_file }}"
                                                                target="_blank">{{ $task->question_file }}</a>
                                                        </div>
                                                    @endif
                                                    <p style="font-size: 0.87rem;">Deadline:
                                                        {{ $task->deadline->format('d-m-y, g:i A') }}</p>
                                                    <form action="{{ route('task-upload', $task->id) }}" method="POST"
                                                        enctype="multipart/form-data" data-remote="true">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="input-group border">
                                                                <input id="upload-{{ $task->id }}" type="file"
                                                                    class="form-control border upload-input"
                                                                    name="file_upload_{{ $task->id }}"
                                                                    onchange="readURL(this, {{ $task->id }})">
                                                                <label id="upload-file-{{ $task->id }}" for="upload"
                                                                    class="font-weight-light text-muted upload-file">Choose
                                                                    file</label>
                                                                <div class="input-group-append">
                                                                    <label for="upload-{{ $task->id }}" class="btn btn-primary m-0 px-4">
                                                                        <i class="fas fa-upload mr-2"></i>
                                                                        <small
                                                                            class="text-uppercase font-weight-bold">Choose
                                                                            file</small></label>
                                                                </div>
                                                            </div>
                                                            @error('file_upload_' . $task->id)
                                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .classroom-task .card:hover {
            transform: scale(1.04);
            transition: 0.2s ease-in-out;
        }

        #modal-update-photo .input-group {
            border-radius: var(--border-radius-1);
        }

        .upload-input {
            opacity: 0;
        }

        .upload-file {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

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

    <script type="text/javascript">
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var fileName = input.files[0].name;
                var infoArea = document.getElementById(`upload-file-${id}`);
                infoArea.textContent = 'File name: ' + fileName;
            }
        }

        $(function() {
            $("#tabel-assignment").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#tabel-assignment_wrapper .col-md-6:eq(0)');

            @if (Session::has('status'))
                @if (Session::get('status') == 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') == 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif

            @if ($errors->any())
                @if (Session::has('failSubmitAnswer'))
                    $('#submit-assigment-{{ Session::get('failSubmitAnswer') }}').modal('show');
                @endif
            @endif
        })
    </script>
@endsection
