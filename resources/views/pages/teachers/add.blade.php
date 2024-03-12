@extends('layouts.template')

@section('title', 'Add Teachers')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Add Teachers</li>
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
                <form class="form-horizontal" action="{{ route('teacher-add') }}" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="fullName" class="form-control form-control-mb" name="name"
                                    placeholder="Full Name" value="{{ old('name', '') }}" />
                                <label for="fullName">Full Name*</label>
                            </div>
                            @error('name')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="email" class="form-control form-control-mb" name="email"
                                    placeholder="Email" value="{{ old('email', '') }}" />
                                <label for="email">Email*</label>
                            </div>
                            @error('email')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="phoneNumber" class="form-control form-control-mb"
                                    name="phone_number" placeholder="Phone Number" value="{{ old('phone_number', '') }}" />
                                <label for="phoneNumber">Phone Number*</label>
                            </div>
                            @error('phone_number')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="date" id="dob" class="form-control form-control-mb" name="dob"
                                    placeholder=">Date of Birth" value="{{ old('dob', '') }}" />
                                <label for="dob">Date of Birth*</label>
                            </div>
                            @error('dob')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" }}" style="width: 100%;"
                                    name="gender">
                                    <option disabled selected>Select a gender</option>
                                    <option value='Male' {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value='Female' {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                                <label for="gender">Gender*</label>
                            </div>
                            @error('gender')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="religion">
                                    <option disabled selected>Select a Religion</option>
                                    <option value='Muslim' {{ old('religion') == 'Muslim' ? 'selected' : '' }}>Muslim
                                    </option>
                                    <option value='Protestant' {{ old('religion') == 'Protestant' ? 'selected' : '' }}>
                                        Protestant
                                    </option>
                                    <option value='Catholic' {{ old('religion') == 'Catholic' ? 'selected' : '' }}>Catholic
                                    </option>
                                    <option value='Hindu' {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value='Buddhist' {{ old('religion') == 'Buddhist' ? 'selected' : '' }}>Buddhist
                                    </option>
                                    <option value='Confucian' {{ old('religion') == 'Confucian' ? 'selected' : '' }}>
                                        Confucian
                                    </option>
                                </select>
                                <label for="religion">Religion*</label>
                            </div>
                            @error('religion')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastEducation" class="form-control form-control-mb" name="latest_education"
                                    placeholder=">Last Education" value="{{ old('latest_education', '') }}" />
                                <label for="lastEducation">Last Education*</label>
                            </div>
                            @error('latest_education')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
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

    <style>
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
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
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
