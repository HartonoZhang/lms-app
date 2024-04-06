@extends('layouts.register')

@section('content')
    <form method="POST" action="{{ route('create-organization') }}" enctype="multipart/form-data" data-remote="true">
        @csrf
        <div class="d-flex align-items-center mb-3 pb-1">
            <span class="h3 fw-bold mb-0">Create Organization</span>
        </div>
        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
            Enter your details to register organization
        </h5>
        <div class="form-group mt-3">
            <div class="form-label-group in-border mb-0">
                <input type="text" class="form-control" placeholder="Enter website name" name="web_name" id="web_name"
                    value="{{ old('web_name') }}">
                <label for="web_name">Website Name*</label>
            </div>
            @error('web_name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <div class="form-label-group in-border mb-0">
                <input type="text" class="form-control" placeholder="Enter organization name" name="name"
                    value="{{ old('name') }}">
                <label for="name">Organization name*</label>
            </div>
            @error('name')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-label-group in-border mb-3">
            <select class="form-control form-control-mb select2" id="category" style="width: 100%;" name="category">
                <option disabled selected>Select a category</option>
                @foreach ($organizationCategory as $category)
                    <option value='{{ $category->id }}' {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <label for="category">Category*</label>
            @error('category')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <div class="input-group border-upload">
                <input id="logo" type="file" onchange="readURL(this);" class="form-control" name="logo">
                <label id="logo-label" for="logo" class="font-weight-light text-muted">
                    Choose logo
                </label>
                <div class="input-group-append">
                    <label for="logo" class="btn btn-primary m-0 px-4">
                        <small class="text-uppercase font-weight-bold">Choose file</small>
                    </label>
                </div>
            </div>
            <small id="logoHelp" class="form-text text-muted">Recommended image size is 150px x
                150px</small>
            @error('logo')
                <p class="text-danger mt-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <div class="input-group border-upload">
                <input id="favicon" type="file" onchange="readURL(this);" class="form-control" name="favicon">
                <label id="favicon-label" for="favicon" class="font-weight-light text-muted">
                    Choose favicon
                </label>
                <div class="input-group-append">
                    <label for="favicon" class="btn btn-primary m-0 px-4">
                        <small class="text-uppercase font-weight-bold">Choose file</small>
                    </label>
                </div>
            </div>
            <small id="faviconHelp" class="form-text text-muted">Recommended image size is 16px x 16px or
                32px
                x 32px</small>
            @error('favicon')
                <p class="text-danger mt-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="pt-4">
            <button class="btn btn-primary btn-block" type="submit">Create</button>
        </div>
    </form>
@endsection

@section('css-link')
    <style>
        .select2-container--bootstrap4.select2-container--focus .select2-selection {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection {
            -webkit-transition: none !important;
        }

        .border-upload {
            border: 1px solid #ced4da;
            border-radius: var(--border-radius-1);
        }

        #logo,
        #favicon {
            opacity: 0;
        }

        #logo-label,
        #favicon-label {
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
    <script type="text/javascript">
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

        inputFavicon.addEventListener('change', showFileNameFavicon);

        function showFileNameFavicon(event) {
            var inputFavicon = event.srcElement;
            var fileName = inputFavicon.files[0].name;
            infoAreaFavicon.textContent = 'File name: ' + fileName;
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
