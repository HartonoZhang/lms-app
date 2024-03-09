@extends('layouts.template')

@section('title', 'Profile')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}"
                                alt="User profile picture">
                            <img class="profile-user-badge" src="{{ asset('assets') }}/images/badges/bronze.png"
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Level</b> <a class="float-right">5</a>
                            </li>
                            <li class="list-group-item">
                                <b>NIM</b> <a class="float-right">1234567890</a>
                            </li>
                        </ul>
                        <button class="btn btn-primary btn-block" data-toggle="modal"
                            data-target="#modal-update-photo"><b>Change Profile Photo</b></button>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-block"><b>Logout</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#security" data-toggle="tab">Security</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" action="/admin/updateProfile" method="POST"
                                    enctype="multipart/form-data" data-remote="true">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName"
                                                placeholder="Input your name" name="name"
                                                value="{{ Auth::user()->name }}">
                                            @error('name')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail"
                                                placeholder="Input your email" name="email"
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" name="gender">
                                                <option value='' selected>Laki laki
                                                </option>
                                                <option value=''>Perempuan
                                                </option>
                                                {{-- @foreach ($listCategory as $category)
                                                    @if ($data->category_id === $category->id)
                                                        <option value={{ $category->id }} selected>{{ $category->name }}
                                                        </option>
                                                    @else
                                                        <option value={{ $category->id }}>{{ $category->name }}</option>
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputGender" class="col-sm-2 col-form-label">Religion</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" name="gender">
                                                <option value='' selected>Muslim
                                                </option>
                                                <option value=''>Protestant
                                                </option>
                                                <option value=''>Catholic
                                                </option>
                                                <option value=''>Hindu
                                                </option>
                                                <option value=''>Buddhist
                                                </option>
                                                <option value=''>Confucian
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAddress"
                                                placeholder="Input your address line" name="address" value="">
                                            <div class="form-row my-2">
                                                <div class="col-sm">
                                                    <input type="text" class="form-control" placeholder="City">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control"
                                                        placeholder="State/Province">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm">
                                                    <input type="text" class="form-control"
                                                        placeholder="Zip/Postal code">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control" placeholder="Country">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPhoneNumber"
                                                placeholder="Input your phone number" name="phoneNumber" value="">
                                            @error('phoneNumber')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputBirthDate" class="col-sm-2 col-form-label">DOB</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="inputBirthDate"
                                                placeholder="Input your birth date" name="birthDate" value="">
                                            @error('birthDate')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="security">
                                <form class="form-horizontal" action="/admin/updatePassword" method="POST"
                                    enctype="multipart/form-data" data-remote="true">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="oldPassword" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="oldPassword"
                                                name="oldPassword" placeholder="Input old password">
                                            @error('oldPassword')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassword"
                                                name="newPassword" placeholder="Input new password">
                                            @error('newPassword')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirmPassword"
                                                name="confirmPassword" placeholder="Input confirm password">
                                            @error('confirmPassword')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-photo">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/updatePhoto" method="POST" enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">Update Profile Photo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control" id="image" name="image">
                            @error('file')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer float-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .profile-user-badge {
            position: absolute;
            margin-left: auto;
            left: 0;
            width: 60px;
            height: 60px;
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
