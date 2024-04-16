@extends('layouts.template')

@section('title', 'Update Task')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course-detail', $classroom->id) }}">Courses Detail</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('task-detail', ['classroom' => $classroom->id, 'task' => $task->id]) }}">Task
            Detail</a></li>
    <li class="breadcrumb-item active">Update Task</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Task Information
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal"
                    action={{ route('update-task', ['classroom' => $classroom->id, 'task' => $task->id]) }} method="POST"
                    enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Teacher" name="teacher_id" value="{{ old('teacher', $task->teacher->id) }}"
                                    hidden />
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Teacher" name="teacher"
                                    value="{{ old('teacher', $task->teacher->user->name) }}" readonly />
                                <label for="teacher">Teacher*</label>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;"
                                    name="category_id">
                                    <option disabled selected>Select a category</option>
                                    @foreach ($listCategory as $category)
                                        @if ($task->task_category_id === $category->id)
                                            <option value="{{ old('category_id', $category->id) }}" selected>
                                                {{ $category->name }} </option>
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
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Title" name="title" value="{{ old('title', $task->title) }}" />
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
                                    rows="3">{{ old('description', $task->description) }}</textarea>
                                <label for="description">Description*</label>
                            </div>
                            @error('description')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="datetime-local" id="deadline" class="form-control form-control-mb"
                                    placeholder="Start Time" name="deadline"
                                    value="{{ old('deadline', $task->deadline) }}" />
                                <label for="deadline">Deadline*</label>
                            </div>
                            @error('deadline')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <label id="upload-file">File name:
                                    {{ $task->question_file ? $task->question_file : '' }}</label>
                                <div class="input-group border">
                                    <input id="upload" type="file" class="form-control border"
                                        onchange="readURL(this)" name="file_upload">
                                    <label for="upload_edit" class="font-weight-light text-muted upload-file">File*</label>
                                    <div class="input-group-append">
                                        <label for="upload" class="btn btn-primary m-0 px-4 text-white">
                                            <i class="fas fa-upload mr-2"></i>
                                            <small class="text-uppercase font-weight-bold">Choose
                                                file</small></label>
                                    </div>
                                </div>
                            </div>
                            @error('file_upload')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('task-detail', ['classroom' => $classroom->id, 'task' => $task->id]) }}"
                        class="btn btn-secondary mt-3">Back</a>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
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

        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var fileName = input.files[0].name;
                    var infoArea = document.getElementById('upload-file');
                    infoArea.textContent = 'File name: ' + fileName;
                }
            }

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
            })
        </script>
    @endsection
