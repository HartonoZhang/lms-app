@extends('layouts.template')

@section('title', 'Detail Teacher')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Detail Teacher</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Teacher Information
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('assets') }}/images/profile/{{ $teacher->user->image }}" alt="User profile picture">
                    <img class="user-badge my-0"
                        src="{{ asset('assets') }}/images/badges/{{ $teacher->profile->badge_name }}.png"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center mt-4">{{ $teacher->name }} </h3>
                <p class="text-muted text-center">Level: {{ $teacher->profile->level }}</p>
                <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="fullName" class="form-control form-control-mb" name="name"
                                    placeholder="Full Name" value="{{ $teacher->name }}" readonly />
                                <label for="fullName">Full Name*</label>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="email" class="form-control form-control-mb" name="email"
                                    placeholder="Email" value="{{ $teacher->user->email }}" readonly />
                                <label for="email">Email*</label>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="phoneNumber" class="form-control form-control-mb"
                                    name="phone_number" placeholder="Phone Number"
                                    value="{{ $teacher->profile->phone_number }}" readonly />
                                <label for="phoneNumber">Phone Number*</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="date" id="dob" class="form-control form-control-mb" name="dob"
                                    placeholder=">Date of Birth" value="{{ $teacher->profile->dob }}"
                                    readonly />
                                <label for="dob">Date of Birth*</label>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="gender"
                                    disabled>
                                    <option value='Male'
                                        {{ $teacher->profile->gender == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value='Female'
                                        {{ $teacher->profile->gender == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                                <label for="gender">Gender*</label>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="religion"
                                    disabled>
                                    <option value='Muslim'
                                        {{ $teacher->profile->religion == 'Muslim' ? 'selected' : '' }}>
                                        Muslim
                                    </option>
                                    <option value='Protestant'
                                        {{ $teacher->profile->religion == 'Protestant' ? 'selected' : '' }}>
                                        Protestant
                                    </option>
                                    <option value='Catholic'
                                        {{ $teacher->profile->religion == 'Catholic' ? 'selected' : '' }}>
                                        Catholic
                                    </option>
                                    <option value='Hindu'
                                        {{ $teacher->profile->religion == 'Hindu' ? 'selected' : '' }}>
                                        Hindu
                                    </option>
                                    <option value='Buddhist'
                                        {{ $teacher->profile->religion == 'Buddhist' ? 'selected' : '' }}>
                                        Buddhist
                                    </option>
                                    <option value='Confucian'
                                        {{ $teacher->profile->religion == 'Confucian' ? 'selected' : '' }}>
                                        Confucian
                                    </option>
                                </select>
                                <label for="religion">Religion*</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastEducation" class="form-control form-control-mb"
                                    name="latest_education" placeholder=">Last Education"
                                    value="{{ $teacher->latest_education }}" readonly />
                                <label for="lastEducation">Last Education*</label>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('teacher-list') }}" class="btn btn-secondary mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        .user-badge {
            width: 60px;
            height: 60px;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 60px;
            right: 0;
            top: 150px;
            text-align: center;
        }

        .profile-user-img {
            width: 120px;
            height: 120px;
        }

        .select2-container--bootstrap4.select2-container--focus .select2-selection {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection {
            -webkit-transition: none !important;
        }

        label {
            font-weight: 400 !important;
        }
    </style>
@endsection

@section('js-script')
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>

    <script type="text/javascript">
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
