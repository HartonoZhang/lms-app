@extends('layouts.template')

@section('title', 'Task Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course-detail-assignment', $classroom->id) }}">Courses Detail</a>
    </li>
    <li class="breadcrumb-item active">Task Detail</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('update-task', ['classroom' => $classroom->id, 'task' => $task->id]) }}"
                class="btn btn-primary mr-2">
                Update
            </a>
            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" data-placement="top"
                title="Delete">
                Delete
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Task Information
                </h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-sm-6 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="title" class="form-control form-control-mb" placeholder="Teacher"
                                name="teacher_id" value="{{ $task->teacher->id }}" hidden />
                            <input type="text" id="title" class="form-control form-control-mb" placeholder="Teacher"
                                name="teacher" value="{{ $task->teacher->user->name }}" readonly />
                            <label for="teacher">Teacher*</label>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <select class="form-control form-control-mb select2" style="width: 100%;" name="category_id"
                                disabled>
                                <option disabled selected>Select a category</option>
                                @foreach ($listCategory as $category)
                                    @if ($task->task_category_id == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }} </option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="category_id">Category*</label>
                        </div>
                        @error('category_id')
                            <p class="text-danger mb-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="title" class="form-control form-control-mb" placeholder="Title"
                                name="title" value="{{ $task->title }}" readonly />
                            <label for="title">Title*</label>
                        </div>
                        @error('title')
                            <p class="text-danger mb-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="classroom" class="form-control form-control-mb"
                                placeholder="Classroom" value="{{ $classroom->name }}" readonly />
                            <label for="classroom">Classroom*</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <textarea id="description" class="form-control form-control-mb" placeholder="Description" name="description"
                                rows="3" readonly>{{ $task->description }}</textarea>
                            <label for="description">Description*</label>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="datetime-local" id="start_time" class="form-control form-control-mb"
                                placeholder="Start Time" name="start_time" value="{{ $task->deadline }}" readonly />
                            <label for="start_time">Deadline*</label>
                        </div>
                        @error('start_time')
                            <p class="text-danger mb-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <input type="text" id="title" class="form-control form-control-mb" placeholder="Title"
                                name="title" value="{{ $task->question_file ? $task->question_file : 'none' }}"
                                readonly />
                            <label for="title">File*</label>
                        </div>
                        <small id="download" class="form-text text-muted">
                            <a href="{{ asset('assets/tasks/question') }}/{{ $task->question_file }}"
                                target="_blank" style="color: var(--color-primary)">Download</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Student Submit
                </h3>
            </div>
            <div class="card-body">
                <table id="tabel-students" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>File Upload</th>
                            <th>Date Upload</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUpload as $upload)
                            <tr>
                                <td class="text-truncate">{{ $upload->student->user->name }}</td>
                                <td class="text-truncate">
                                    <a href="{{ asset('assets/tasks/answer') }}/{{ $upload->file_upload }}"
                                        target="_blank" style="color: var(--color-primary)">Download</a>
                                </td>
                                <td>{{ $upload->created_at->format('g:i A, d-m-y') }}</td>
                                <td>{{ $upload->status }}</td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-danger btn-sm rounded-0" data-toggle="modal"
                                                data-target="#revision-{{ $task->id }}" data-placement="top">
                                                Revision
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-success btn-sm rounded-0"
                                                data-toggle="modal" data-target="#done-{{ $task->id }}"
                                                data-placement="top">
                                                Done
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <div class="modal fade" id="revision-{{ $task->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="revision" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Revision</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('revision-upload', ['task' => $task->id, 'student' => $upload->student->id]) }}"
                                                method="POST" enctype="multipart/form-data" data-remote="true">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-label-group in-border">
                                                    <input type="text" id="note"
                                                        class="form-control form-control-mb" placeholder="Input note"
                                                        name="note" value="{{ old('note') }}" />
                                                    <label for="note">Note (Opsional)</label>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="submit" class="btn btn-primary rounded">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="done-{{ $task->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="done" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Done</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('done-upload', ['task' => $task->id, 'student' => $upload->student->id]) }}"
                                                method="POST" enctype="multipart/form-data" data-remote="true">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-label-group in-border">
                                                    <input type="text" id="note"
                                                        class="form-control form-control-mb" placeholder="Input note"
                                                        name="note" value="{{ old('note') }}" />
                                                    <label for="note">Note (Opsional)</label>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="submit" class="btn btn-primary rounded">Send</button>
                                                </div>
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

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action={{ route('delete-task', ['classroom' => $classroom->id, 'task' => $task->id]) }}
                    method="POST" enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title">Remove Task
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to remove
                            "{{ $task->title }}" task?
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
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

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <style>
        .select2-container--bootstrap4.select2-container--focus .select2-selection {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection {
            -webkit-transition: none !important;
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

            $("#tabel-students").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 4
                }],
            }).buttons().container().appendTo('#tabel-students_wrapper .col-md-6:eq(0)');

            @if (Session::has('status'))
                @if (Session::get('status') == 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') == 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif
        })
    </script>
@endsection
