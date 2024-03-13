@extends('layouts.template')

@section('title', 'Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Website Basic Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action={{ route('organization-edit') }} method="POST"
                            enctype="multipart/form-data" data-remote="true">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="inputName">Website Name *</label>
                                <input type="text" id="inputName" class="form-control" value="{{ $organization->name }}"
                                    name="name">
                                @error('name')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Logo *</label>
                                <div class="input-group border-upload">
                                    <input id="logo" type="file" onchange="readURL(this);" class="form-control"
                                        name="logo" value="{{ $organization->logo }}">
                                    <label id="logo-label" for="logo" class="font-weight-light text-muted">
                                        {{ $organization->logo ? 'File name: ' . $organization->logo : 'Choose file' }}
                                    </label>
                                    <div class="input-group-append">
                                        <label for="logo" class="btn btn-primary m-0 px-4">
                                            <i class="fas fa-logo mr-2"></i>
                                            <small class="text-uppercase font-weight-bold">Choose file</small></label>
                                    </div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Recommended image size is 150px x
                                    150px</small>
                                @error('logo')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                                <div class="row mt-2">
                                    <div
                                        class="current-logo col-md-6 d-flex flex-column align-items-center justify-content-center">
                                        <span>Current Logo</span>
                                        <img class="img-fluid img-circle mt-2"
                                            src="{{ asset('assets') }}/images/organization/{{ $organization->logo }}"
                                            alt="User profile picture" style="width: 150px; height: 150px;">
                                    </div>

                                    <div class="image-area col-md-6"><img id="logo-result" src="#" alt=""
                                            class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Favicon *</label>
                                <div class="input-group border-upload">
                                    <input id="favicon" type="file" onchange="readURL(this);" class="form-control"
                                        name="favicon" value="{{ $organization->favicon }}">
                                    <label id="favicon-label" for="favicon" class="font-weight-light text-muted">
                                        {{ $organization->favicon ? 'File name: ' . $organization->favicon : 'Choose file' }}
                                    </label>
                                    <div class="input-group-append">
                                        <label for="favicon" class="btn btn-primary m-0 px-4">
                                            <i class="fas fa-upload mr-2"></i>
                                            <small class="text-uppercase font-weight-bold">Choose file</small></label>
                                    </div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Recommended image size is 16px x 16px or
                                    32px
                                    x 32px</small>
                                @error('favicon')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                                <div class="row mt-2">
                                    <div
                                        class="current-logo col-md-6 d-flex flex-column align-items-center justify-content-center">
                                        <span>Current Favicon</span>
                                        <img class="img-fluid img-circle mt-2"
                                            src="{{ asset('assets') }}/images/organization/{{ $organization->favicon }}"
                                            alt="favicon" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="image-area col-md-6"><img id="favicon-result" src="#" alt=""
                                            class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
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

        #favicon,
        #logo {
            opacity: 0;
        }

        #favicon-label,
        #logo-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area,
        .current-logo {
            border: 2px dashed rgba(161, 141, 141, 0.7);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: gray;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
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
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        var inputLogo = document.getElementById('logo');
        var infoAreaLogo = document.getElementById('logo-label');

        inputLogo.addEventListener('change', showFileName);

        function showFileName(event) {
            var inputLogo = event.srcElement;
            var fileName = inputLogo.files[0].name;
            infoAreaLogo.textContent = 'File name: ' + fileName;
        }

        var inputFavicon = document.getElementById('favicon');
        var infoAreaFavicon = document.getElementById('favicon-label');

        inputFavicon.addEventListener('change', showFileName2);

        function showFileName2(event) {
            var inputFavicon = event.srcElement;
            var fileName = inputFavicon.files[0].name;
            infoAreaFavicon.textContent = 'File name: ' + fileName;
        }

        $(function() {
            $('#logo').on('change', function() {
                readURL(inputLogo, 'logo-result');
            });

            $('#favicon').on('change', function() {
                readURL(inputFavicon, 'favicon-result');
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
