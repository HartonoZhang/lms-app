@extends('layouts.template')

@section('title', 'Courses Detail - Assignment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Assignment</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @include('pages.courses.teacher.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="pill">Assignment</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane show fade" id="list">
                        <div class="row">
                            @foreach ($classroom->tasks as $task)
                                <a href="{{ route('task-detail',['classroom' => $classroom->id, 'task' => $task->id]) }}"
                                    class="col-md-4">
                                    <div class="classroom-task">
                                        <div class="card card-primary card-outline">
                                            <h6 class="card-header text-truncate">{{ $task->title }}</h6>
                                            <div class="card-body">
                                                <p class="card-text" style="font-size: 0.87rem;">{{ $task->description }}
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-primary mr-2">{{ $task->category->name }}</span>
                                                    <small class="ml-auto">Deadline:
                                                        {{ $task->deadline->format('d-m-y, g:i A') }} </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                {{-- <div class="modal fade" id="submit-assigment-{{ $task->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="submit-assigment" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Submit Assignment</h5>
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
                                                    <div class="form-group" data-input="title">
                                                        <div class="input-group border">
                                                            <input id="upload" type="file" class="form-control border"
                                                                name="file_upload_{{ $task->id }}"
                                                                onchange="readURL(this, {{ $task->id }})">
                                                            <label id="upload-file-{{ $task->id }}" for="upload"
                                                                class="font-weight-light text-muted upload-file">Choose
                                                                file</label>
                                                            <div class="input-group-append">
                                                                <label for="upload" class="btn btn-primary m-0 px-4">
                                                                    <i class="fas fa-upload mr-2"></i>
                                                                    <small class="text-uppercase font-weight-bold">Choose
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
                                </div> --}}
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="tab-pane show fade" id="status">
                        <table id="tabel-assignment" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Type</th>
                                    <th>Deadline</th>
                                    <th>Upload Date</th>
                                    <th>Status</th>
                                    <th>File Upload</th>
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
                                                    if ($upload->student->user->id === Auth::user()->id) {
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
                                                    if ($upload->student->user->id === Auth::user()->id) {
                                                        $status = $upload->status;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $status }}
                                        </td>
                                        <td>
                                            @php
                                                $file = 'No data';
                                                foreach ($task->uploads as $upload) {
                                                    if ($upload->student->user->id === Auth::user()->id) {
                                                        $file = $upload->file_upload;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            @if ($file === 'No data')
                                                {{ $file }}
                                            @else
                                                <a href="{{ asset('assets/tasks/answer') }}/{{ $file }}"
                                                    target="_blank">Download</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
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

        #upload {
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
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif
        })
    </script>
@endsection
