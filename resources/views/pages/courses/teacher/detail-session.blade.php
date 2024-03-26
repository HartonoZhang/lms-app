@extends('layouts.template')

@section('title', 'Courses Detail - Sessions')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item active">Courses Detail - Sessions</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary mb-2" href="{{ route('create-session', $classroom->id) }}">Create Session</a>
        </div>
        @include('pages.courses.teacher.course-detail-info', [
            'classroom' => $classroom,
            'teacherClassroom' => $teacherClassroom,
            'sessions' => $sessions,
        ])
        @if (count($sessions))
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="card card-primary card-outline">
                    <div class="card-header mx-auto">
                        <h3 class="card-title font-weight-bold" id="sessionText">Session 1</h3>
                    </div>
                    <div class="card-body my-0 py-0">
                        <ol class="carousel-indicators my-0 py-0">
                            @foreach ($sessions as $key => $item)
                                <li data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}"
                                    class="{{ $key === 0 ? 'active' : '' }}">{{ $key + 1 }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div class="carousel-inner">
                    @foreach ($sessions as $key => $item)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="col-md-11 px-0 mx-auto">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active"
                                                    href="#description-{{ $item->id }}"
                                                    data-toggle="pill">Description</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="#learningMaterial-{{ $item->id }}" data-toggle="pill">Learning
                                                    Material</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#forum-{{ $item->id }}"
                                                    data-toggle="pill">Forum</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#attendance-{{ $item->id }}"
                                                    data-toggle="pill">Attendance</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane show fade" id="description-{{ $item->id }}">
                                                <div class="d-flex justify-content-end">
                                                    <a href="{{ route('update-session', $item->id) }}"
                                                        class="btn btn-primary mr-2">Update</a>
                                                    <a data-toggle="modal" data-target="#modal-delete-session-{{ $item->id }}"
                                                        data-placement="top" title="Delete"
                                                        class="btn btn-danger">Delete</a>
                                                    </a>
                                                    <div class="modal fade" id="modal-delete-session-{{ $item->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action={{ route('delete-session', $item->id) }}
                                                                    method="POST" enctype="multipart/form-data"
                                                                    data-remote="true">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Remove Session
                                                                        </h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure want to remove
                                                                            "{{ $item->title }}" session?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Confirm</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3>{{ $item->title }}</h3>
                                                <p class="pb-2 border-bottom" style="font-size: 1.25rem;">
                                                    {{ $item->description }}</p>
                                                <p>Start Time : {{ $item->start_time->format('g:i A, d-m-y') }}</p>
                                                <p>End Time : {{ $item->end_time->format('g:i A, d-m-y') }}</p>
                                                <a href="#" class="btn btn-primary">Join Now</a>
                                            </div>
                                            <div class="tab-pane fade" id="learningMaterial-{{ $item->id }}">
                                                <div class="d-flex justify-content-end">
                                                    <button data-toggle="modal" data-target="#add-material-modal"
                                                        data-sessionId="{{ $item->id }}"
                                                        class="btn btn-primary mb-2">Add Material</button>
                                                </div>
                                                @if (count($item->materials) === 0)
                                                    <p class="text-center">No have materials</p>
                                                @else
                                                    <table id="tabel-materials" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item->materials as $material)
                                                                <tr>
                                                                    <td class="text-truncate">
                                                                        @if ($material->is_file)
                                                                            <a href="{{ asset('assets/material') }}/{{ $material->value }}"
                                                                                target="_blank">
                                                                                {{ $material->title }}</a>
                                                                        @else
                                                                            <a href="{{ $material->value }}"
                                                                                target="_blank">
                                                                                {{ $material->title }}
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-inline m-0">
                                                                            <li class="list-inline-item">
                                                                                <a href="{{ route('edit-material', $material->id) }}"
                                                                                    class="btn btn-success btn-sm rounded-0"
                                                                                    title="Edit"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <a href="#"
                                                                                    class="btn btn-danger btn-sm rounded-0"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-delete-material-{{ $material->id }}"
                                                                                    data-placement="top" title="Delete">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <div class="modal fade"
                                                                    id="modal-delete-material-{{ $material->id }}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <form
                                                                                action={{ route('delete-material', $material->id) }}
                                                                                method="POST"
                                                                                enctype="multipart/form-data"
                                                                                data-remote="true">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Remove Material
                                                                                    </h4>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Are you sure want to remove
                                                                                        "{{ $material->title }}" material?
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="modal-footer justify-content-between">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Cancel</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Confirm</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="forum-{{ $item->id }}">
                                                <div class="d-flex justify-content-end">
                                                    <button data-toggle="modal" data-target="#add-thread-modal"
                                                        data-sessionId="{{ $item->id }}"
                                                        class="btn btn-primary mb-2">Add Thread</button>
                                                </div>
                                                @if (count($item->threads))
                                                    @foreach ($item->threads as $thread)
                                                        <a href="{{ route('thread-detail', $thread->id) }}">
                                                            <div class="card border">
                                                                <div class="card-header pl-3 pt-2">
                                                                    <div class="d-flex justify-content-between ">
                                                                        <div class="d-flex flex-column ">
                                                                            <div class="user-block">
                                                                                <img loading="lazy" class="img-circle"
                                                                                    src="{{ url('/assets/images/profile/') }}/{{ $thread->user->image }}"
                                                                                    alt="User Image">
                                                                                <span
                                                                                    class="username fw-normal">{{ $thread->user->name }}</span>
                                                                                <span
                                                                                    class="description">{{ $thread->created_at->format('g:iA, d-m-y') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="float-right text-muted"
                                                                            style="font-size: 0.85rem;">{{ count($thread->comments) }}
                                                                            comments</span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="my-0">{{ $thread->title }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <p class="text-center">There are no forum yet</p>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="attendance-{{ $item->id }}">
                                                <form class="form-horizontal" action="#" method="POST"
                                                    enctype="multipart/form-data" data-remote="true">
                                                    @csrf
                                                    <table id="tabel-attendances"
                                                        class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Student Name</th>
                                                                <th>Present</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($listStudent as $student)
                                                                <tr>
                                                                    <td>
                                                                        <div class="user-block">
                                                                            <img class="img-circle img-bordered-sm"
                                                                                src="{{ url('/assets/images/profile/') }}/{{ $student->student->user->image }}"
                                                                                alt="user image">
                                                                            <span class="username text-truncate">
                                                                                {{ $student->student->user->name }}
                                                                            </span>
                                                                            <span class="description text-truncate">
                                                                                {{ $student->student->user->email }}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="student-checkbox-{{ $student->id }}" />
                                                                            <label class="custom-control-label"
                                                                                for="student-checkbox-{{ $student->id }}"></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev d-lg-flex d-none" type="button"
                    data-target="#carouselExampleCaptions" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next d-lg-flex d-none" type="button"
                    data-target="#carouselExampleCaptions" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        @else
            <div class="card card-primary card-outline">
                <div class="card-header mx-auto">
                    <h3 class="card-title">There no sessions yet</h3>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="add-thread-modal" tabindex="-1" role="dialog" aria-labelledby="add-thread-modal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Thread</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('thread-post') }}">
                        @csrf
                        <input type="text" class="form-control" name="sessionId" id="threadSessionIdInput"
                            value="{{ old('sessionId') }}" hidden>
                        <div class="form-group" data-input="title">
                            <label for="threadTitle">Title</label>
                            <input type="text" class="form-control" name="title" id="threadTitle"
                                placeholder="Thread Title" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" data-input="description">
                            <label for="threadDescription">Description</label>
                            <textarea type="text" class="form-control" name="description" id="threadDescription"
                                placeholder="Thread Description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Post Thread</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-material-modal" tabindex="-1" role="dialog" aria-labelledby="add-thread-modal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('create-material') }}" enctype="multipart/form-data"
                        data-remote="true">
                        @csrf
                        <input type="text" class="form-control" name="material_sessionId" id="materialSessionIdInput"
                            value="{{ old('material_sessionId') }}" hidden>
                        <div class="form-group">
                            <label for="materialTitle">Title</label>
                            <input type="text" class="form-control" name="material_title" id="materialTitle"
                                placeholder="Title" value="{{ old('material_title') }}">
                            @error('material_title')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" id="link_input">
                            <label for="materialValue">Link URl</label>
                            <input type="text" class="form-control" name="material_value" id="materialValue"
                                placeholder="Value" value="{{ old('material_value') }}">
                            @error('material_value')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" id="file_input">
                            <label>File</label>
                            <div class="input-group border">
                                <input id="upload" type="file" class="form-control border" name="file_upload"
                                    onchange="readURL(this)">
                                <label id="upload-file" for="upload"
                                    class="font-weight-light text-muted upload-file">Choose
                                    file</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-primary m-0 px-4">
                                        <i class="fas fa-upload mr-2"></i>
                                        <small class="text-uppercase font-weight-bold">Choose
                                            file</small></label>
                                </div>
                            </div>
                            @error('file_upload')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="icheck-primary mt-2">
                            <input type="checkbox" id="checkboxFile" name="is_file"
                                {{ old('is_file') ? 'checked' : '' }}>
                            <label for="checkboxFile">
                                Is File?
                            </label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create Material</button>
                        </div>
                    </form>
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
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <style>
        .carousel-inner {
            padding-bottom: 40px;
        }

        .icheck-primary label {
            font-weight: 400 !important;
        }

        .carousel-indicators {
            position: relative;
        }

        .carousel-control-prev,
        .carousel-control-next {
            height: 40px;
            width: 40px;
            outline: var(--color-primary);
            border-radius: 50%;
            top: 55%;
            border: 1px solid var(--color-primary);
            background-color: var(--color-primary);
            transform: translate(0, -50%);
        }

        .carousel .carousel-indicators li,
        .carousel .carousel-indicators li.active {
            background-color: var(--color-primary);
        }

        #upload_edit,
        #upload {
            opacity: 0;
        }

        .upload-file-edit,
        .upload-file {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .table {
            table-layout: fixed;
        }

        .carousel-indicators li {
            border-radius: 50%;
            width: 27px;
            height: 27px;
            text-indent: -1px;
            color: white;
            text-align: center;
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var fileName = input.files[0].name;
                var infoArea = document.getElementById('upload-file');
                infoArea.textContent = 'File name: ' + fileName;
            }
        }

        $(document).ready(function() {
            $("#tabel-attendances").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    orderable: false,
                    targets: 1
                }],
            }).buttons().container().appendTo('#tabel-attendances_wrapper .col-md-6:eq(0)');

            $('#carouselExampleCaptions').on('slid.bs.carousel', function(e) {
                var ele = $('#carouselExampleCaptions .carousel-indicators li.active');
                var $sessions = $('#sessionText');
                $sessions.text(`Session ${ele.data('slideTo') + 1}`);
            })

            $('*[data-target="#add-thread-modal"]').click(function() {
                var sessionId = $(this).attr('data-sessionId');
                $("#threadSessionIdInput").val(sessionId);
            });

            $('*[data-target="#add-material-modal"]').click(function() {
                var sessionId = $(this).attr('data-sessionId');
                $("#materialSessionIdInput").val(sessionId);
            });

            if ($('#checkboxFile').is(':checked') == true) {
                $('#link_input').hide();
                $('#file_input').show();
            } else {
                $('#link_input').show();
                $('#file_input').hide();
            }

            $('#checkboxFile').click(function() {
                if ($(this).prop('checked')) {
                    $('#link_input').hide();
                    $('#file_input').show();
                } else {
                    $('#link_input').show();
                    $('#file_input').hide();
                }
            });

            @if ($errors->any())
                @if (Session::has('failPostThread'))
                    $('#add-thread-modal').modal('show');
                @endif

                @if (Session::has('failCreateMaterial'))
                    $('#add-material-modal').modal('show');
                @endif
            @endif

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
