@extends('layouts.template')

@section('title', 'Posts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Create Post</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Post</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action={{ route('post-create') }} method="POST"
                            enctype="multipart/form-data" data-remote="true">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title *</label>
                                <input type="text" id="title" class="form-control" name="title"
                                    value="{{ old('title') }}" placeholder="Input title">
                                @error('title')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description *</label>
                                <textarea id="description" class="form-control" name="description" rows="3"
                                    placeholder="Input description">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Image (optional)</label>
                                <div class="input-group border-upload">
                                    <input id="image" type="file" onchange="readURL(this);" class="form-control"
                                        name="image">
                                    <label id="image-label" for="image" class="font-weight-light text-muted">
                                        Choose first image
                                    </label>
                                    <div class="input-group-append">
                                        <label for="image" class="btn btn-primary m-0 px-4">
                                            <i class="fas fa-logo"></i>
                                            <small class="text-uppercase font-weight-bold">Choose file</small>
                                        </label>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                                <div class="input-group border-upload mt-2">
                                    <input id="image_2" type="file" onchange="readURL(this);" class="form-control"
                                        name="image_2">
                                    <label id="image_2-label" for="image_2" class="font-weight-light text-muted">
                                        Choose second image
                                    </label>
                                    <div class="input-group-append">
                                        <label for="image_2" class="btn btn-primary m-0 px-4">
                                            <i class="fas fa-logo"></i>
                                            <small class="text-uppercase font-weight-bold">Choose file</small>
                                        </label>
                                    </div>
                                </div>
                                @error('image_2')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                                <div class="input-group mt-2">
                                    <div
                                        class="image-area col-md-6 d-flex flex-column align-items-center justify-content-center">
                                        <span>Image 1 upload result</span>
                                        <img id="image-result" src="#" alt="" class="img-fluid mt-2">
                                    </div>
                                    <div
                                        class="image-area col-md-6 d-flex flex-column align-items-center justify-content-center">
                                        <span>Image 2 upload result</span>
                                        <img id="image_2-result" src="#" alt="" class="img-fluid mt-2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link">Link (optional)</label>
                                <input type="text" id="link" class="form-control" name="link"
                                    value="{{ old('link') }}" placeholder="Input first link">
                                @error('link')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                                <input type="text" id="link_2" class="form-control mt-2" name="link_2"
                                    value="{{ old('link_2') }}" placeholder="Input second link">
                                @error('link_2')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">File (optional)</label>
                                <div class="input-group border-upload">
                                    <input id="file" type="file" onchange="readURL(this);" class="form-control"
                                        name="file">
                                    <label id="file-label" for="file" class="font-weight-light text-muted">
                                        Choose file
                                    </label>
                                    <div class="input-group-append">
                                        <label for="file" class="btn btn-primary m-0 px-4">
                                            <i class="fas fa-logo"></i>
                                            <small class="text-uppercase font-weight-bold">Choose file</small>
                                        </label>
                                    </div>
                                </div>
                                @error('file')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <style>
        .border-upload {
            border: 1px solid #ced4da;
            border-radius: var(--border-radius-1);
        }

        #file,
        #image_2,
        #image {
            opacity: 0;
        }

        #file-label,
        #image_2-label,
        #image-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area {
            border: 2px dashed rgba(161, 141, 141, 0.7);
            padding: 1rem;
            position: relative;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        function readURL(input, place) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(`#${place}`)
                        .attr('src', e.target.result);
                    $(`#${place}`)
                        .attr('style');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        var inputImage = document.getElementById('image');
        var infoAreaImage = document.getElementById('image-label');

        inputImage.addEventListener('change', showFileName);

        function showFileName(event) {
            var inputImage = event.srcElement;
            var fileName = inputImage.files[0].name;
            infoAreaImage.textContent = 'File name: ' + fileName;
        }

        var inputImage2 = document.getElementById('image_2');
        var infoAreaImage2 = document.getElementById('image_2-label');

        inputImage2.addEventListener('change', showFileName2);

        function showFileName2(event) {
            var inputImage2 = event.srcElement;
            var fileName = inputImage2.files[0].name;
            infoAreaImage2.textContent = 'File name: ' + fileName;
        }

        var inputFile = document.getElementById('file');
        var infoAreaFile = document.getElementById('file-label');

        inputFile.addEventListener('change', showFileName3);

        function showFileName3(event) {
            var inputFile = event.srcElement;
            var fileName = inputFile.files[0].name;
            infoAreaFile.textContent = 'File name: ' + fileName;
        }

        $(function() {
            $('#image').on('change', function() {
                readURL(inputImage, 'image-result');
            });

            $('#image_2').on('change', function() {
                readURL(inputImage2, 'image_2-result');
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
