@extends('layouts.template')

@section('title', 'Update Material')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course-detail', $classroom->id) }}">Courses Detail</a></li>
    <li class="breadcrumb-item active">Update Material</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Update Material
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action={{ route('edit-material', $material->id) }} method="POST"
                    enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Title" name="title" value="{{ old('title', $material->title) }}" />
                                <label for="title">Title*</label>
                            </div>
                            @error('title')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            @if ($material->is_file)
                                <div class="form-label-group in-border mb-1">
                                    <label id="upload-file">File name: {{ $material->value }}</label>
                                    <div class="input-group border">
                                        <input id="upload" type="file" class="form-control border"
                                            onchange="readURL(this)" name="file_upload">
                                        <label for="upload_edit"
                                            class="font-weight-light text-muted upload-file">File*</label>
                                        <div class="input-group-append">
                                            <label for="upload" class="btn btn-primary m-0 px-4 text-white">
                                                <i class="fas fa-upload mr-2"></i>
                                                <small class="text-uppercase font-weight-bold">Choose
                                                    file</small></label>
                                        </div>
                                    </div>
                                </div>
                                @error('file_upload')
                                    <p class="text-danger mb-1">
                                        {{ $message }}</p>
                                @enderror
                            @else
                                <div class="form-group">
                                    <div class="form-label-group in-border mb-1">
                                        <input type="text" id="value" class="form-control form-control-mb"
                                            placeholder="Value" name="value"
                                            value="{{ old('value', $material->value) }}" />
                                        <label for="value">Link URl*</label>
                                    </div>
                                    @error('value')
                                        <p class="text-danger mb-1">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>
                    <a type="button" href="{{ route('teacher-course-detail', $classroom->id) }}"
                        class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
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

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var fileName = input.files[0].name;
                var infoArea = document.getElementById('upload-file');
                infoArea.textContent = 'File name: ' + fileName;
            }
        }

        $(function() {
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
