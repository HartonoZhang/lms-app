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
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#organization"
                                    data-toggle="pill">Organization</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#gamification" data-toggle="pill">Gamification
                                    EXP</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane show fade" id="organization">
                                <form class="form-horizontal" action={{ route('organization-edit') }} method="POST"
                                    enctype="multipart/form-data" data-remote="true">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="inputWebName">Website Name *</label>
                                        <input type="text" id="inputWebName" class="form-control"
                                            value="{{ $organization->web_name }}" name="web_name">
                                        @error('web_name')
                                            <p class="text-danger mt-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Organization Name *</label>
                                        <input type="text" id="inputName" class="form-control"
                                            value="{{ $organization->name }}" name="name">
                                        @error('name')
                                            <p class="text-danger mt-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Logo *</label>
                                        <div class="input-group border-upload">
                                            <input id="logo" type="file" onchange="readURL(this);"
                                                class="form-control" name="logo">
                                            <label id="logo-label" for="logo" class="font-weight-light text-muted">
                                                {{ $organization->logo ? 'File name: ' . $organization->logo : 'Choose file' }}
                                            </label>
                                            <div class="input-group-append">
                                                <label for="logo" class="btn btn-primary m-0 px-4">
                                                    <i class="fas fa-logo mr-2"></i>
                                                    <small class="text-uppercase font-weight-bold">Choose
                                                        file</small></label>
                                            </div>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Recommended image size is 150px x
                                            150px</small>
                                        @error('logo')
                                            <p class="text-danger mt-0">{{ $message }}</p>
                                        @enderror
                                        <div class="row mt-2">
                                            <div
                                                class="image-area col-md-6 d-flex flex-column align-items-center justify-content-center">
                                                <span>Current Logo</span>
                                                <img class="img-fluid img-circle mt-2"
                                                    src="{{ asset('assets') }}/images/organization/{{ $organization->logo }}"
                                                    alt="User profile picture" style="width: 150px; height: 150px;">
                                            </div>
                                            <div
                                                class="image-area col-md-6 d-flex flex-column align-items-center justify-content-center">
                                                <span>New Logo</span>
                                                <img id="logo-result" src="#" alt=""
                                                    class="img-fluid img-circle mt-2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Favicon *</label>
                                        <div class="input-group border-upload">
                                            <input id="favicon" type="file" onchange="readURL(this);"
                                                class="form-control" name="favicon">
                                            <label id="favicon-label" for="favicon" class="font-weight-light text-muted">
                                                {{ $organization->favicon ? 'File name: ' . $organization->favicon : 'Choose file' }}
                                            </label>
                                            <div class="input-group-append">
                                                <label for="favicon" class="btn btn-primary m-0 px-4">
                                                    <i class="fas fa-upload mr-2"></i>
                                                    <small class="text-uppercase font-weight-bold">Choose
                                                        file</small></label>
                                            </div>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Recommended image size is 16px x
                                            16px or
                                            32px
                                            x 32px</small>
                                        @error('favicon')
                                            <p class="text-danger mt-0">{{ $message }}</p>
                                        @enderror
                                        <div class="row mt-2">
                                            <div
                                                class="image-area col-md-6 d-flex flex-column align-items-center justify-content-center">
                                                <span>Current Favicon</span>
                                                <img class="img-fluid img-circle mt-2"
                                                    src="{{ asset('assets') }}/images/organization/{{ $organization->favicon }}"
                                                    alt="favicon" style="width: 150px; height: 150px;">
                                            </div>
                                            <div
                                                class="image-area col-md-6 d-flex flex-column align-items-center justify-content-center">
                                                <span>New Favicon</span>
                                                <img id="favicon-result" src="#" alt=""
                                                    class="img-fluid img-circle mt-2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane show fade" id="gamification">
                                <form class="form-horizontal" action="{{ route('exp-setting-edit') }}" method="POST"
                                    enctype="multipart/form-data" data-remote="true">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="exp_bronze">Max Exp for Bronze Badge*</label>
                                            <input type="text" id="exp_bronze" class="form-control"
                                                value="{{ old('exp_bronze', $expSetting->exp_bronze) }}" name="exp_bronze">
                                            @error('exp_bronze')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exp_silver">Max Exp for Silver Badge*</label>
                                            <input type="text" id="exp_silver" class="form-control"
                                                value="{{ old('exp_silver', $expSetting->exp_silver) }}" name="exp_silver">
                                            @error('exp_silver')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exp_gold">Max Exp for Gold Badge*</label>
                                            <input type="text" id="exp_gold" class="form-control"
                                                value="{{ old('exp_gold', $expSetting->exp_gold) }}" name="exp_gold">
                                            @error('exp_gold')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exp_purple">Max Exp for Purple Badge*</label>
                                            <input type="text" id="exp_purple" class="form-control"
                                                value="{{ old('exp_purple', $expSetting->exp_purple) }}" name="exp_purple">
                                            @error('exp_purple')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exp_emerald">Max Exp for Emerald Badge*</label>
                                            <input type="text" id="exp_emerald" class="form-control"
                                                value="{{ old('exp_emerald', $expSetting->exp_emerald) }}" name="exp_emerald">
                                            @error('exp_emerald')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="do_quest">Student Question*</label>
                                            <input type="text" id="do_quest" class="form-control"
                                                value="{{ old('do_quest', $expSetting->do_quest) }}" name="do_quest">
                                            @error('do_quest')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="do_asg">Student Assignment*</label>
                                            <input type="text" id="do_asg" class="form-control"
                                                value="{{ old('do_asg', $expSetting->do_asg) }}" name="do_asg">
                                            @error('do_asg')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="do_exam">Student Exam*</label>
                                            <input type="text" id="do_exam" class="form-control"
                                                value="{{ old('do_exam', $expSetting->do_exam) }}" name="do_exam">
                                            @error('do_exam')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="do_project">Student Project*</label>
                                            <input type="text" id="do_project" class="form-control"
                                                value="{{ old('do_project', $expSetting->do_project) }}" name="do_project">
                                            @error('do_project')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="create_question">Teacher Question*</label>
                                            <input type="text" id="create_question" class="form-control"
                                                value="{{ old('create_question', $expSetting->create_question) }}" name="create_question">
                                            @error('create_question')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="create_task">Teacher Task*</label>
                                            <input type="text" id="create_task" class="form-control"
                                                value="{{  old('create_task', $expSetting->create_task) }}" name="create_task">
                                            @error('create_task')
                                                <p class="text-danger my-0">{{ $message }}</p>
                                            @enderror
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
                            .attr('style', 'width:150px; height:150px');
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
