@extends('layouts.template')

@section('title', 'Profile')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
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
                                src="{{ asset('assets') }}/images/profile/{{ $admin->user->image }}"
                                alt="User profile picture" style="width: 120px; height: 120px;">
                        </div>
                        <h3 class="profile-username text-center">{{ $admin->user->name }}</h3>
                        <p class="text-muted text-center">{{ $admin->user->email }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Teachers</b> <a class="float-right">{{ count($teachers) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Students</b> <a class="float-right">{{ count($students) }}</a>
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
                            <li class="nav-item"><a class="nav-link active" href="#posts" data-toggle="tab">Posts</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#security" data-toggle="tab">Security</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="posts">
                                @if (count($posts) == 0)
                                    <p class="d-flex justify-content-center align-items-center flex-column">
                                        <img src="{{ asset('assets') }}/images/icons/no-data.png" alt="no-data"
                                            width="150" height="150">
                                        There are no post yet!
                                    </p>
                                @else
                                    @foreach ($posts as $item)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('assets') }}/images/profile/{{ $admin->user->image }}"
                                                    alt="user image">
                                                <span class="username">
                                                    {{ $admin->user->name }}
                                                </span>
                                                <span
                                                    class="description">{{ $item->created_at->format('g:i, A d-m-y') }}</span>
                                            </div>
                                            <a href="{{ route('post-detail', $item->id) }}">
                                                <h6>{{ $item->title }}</h6>
                                            </a>
                                            <p class="post-description">
                                                {{ $item->description }}
                                            </p>

                                            <p class="d-flex justify-content-end">
                                                <a href="{{ route('post-detail', $item->id) }}" class="text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments
                                                    ({{ count($item->comment) }})
                                                </a>
                                            </p>
                                        </div>
                                    @endforeach
                                    {{ $posts->links() }}
                                @endif
                            </div>
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal" action={{ route('update-admin-profile') }} method="POST"
                                    enctype="multipart/form-data" data-remote="true">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="Name" class="form-control" id="inputName"
                                                placeholder="Input your name" name="name"
                                                value="{{ old('name', $admin->user->name) }}">
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
                                                value="{{ old('email', $admin->user->email) }}">
                                            @error('email')
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
                                <form class="form-horizontal" action={{ route('update-admin-password') }} method="POST"
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
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>

    <div class="modal fade" id="modal-update-photo">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action={{ route('update-admin-photo') }} method="POST" enctype="multipart/form-data"
                    data-remote="true">
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
                            <div class="input-group border">
                                <input id="upload" type="file" onchange="readURL(this);"
                                    class="form-control border" name="image">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose
                                    file</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-primary m-0 px-4">
                                        <i class="fas fa-upload mr-2"></i>
                                        <small class="text-uppercase font-weight-bold">Choose file</small></label>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-danger mt-0">{{ $message }}</p>
                            @enderror
                            <div class="image-area mt-4"><img id="imageResult" src="#" alt=""
                                    class="img-fluid rounded shadow-sm mx-auto d-block"></div>

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

    <style>
        #modal-update-photo .input-group {
            border-radius: var(--border-radius-1);
        }

        #upload {
            opacity: 0;
        }

        #upload-label {
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });

            @if ($errors->any())
                @if (Session::has('failUpload'))
                    $('#modal-update-photo').modal('show');
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
