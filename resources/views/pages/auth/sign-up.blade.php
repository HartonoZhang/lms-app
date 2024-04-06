@extends('layouts.register')

@section('content')
    <form method="POST" action="{{ route('create-admin') }}" enctype="multipart/form-data" data-remote="true">
        @csrf
        <div class="d-flex align-items-center mb-3 pb-1">
            <span class="h3 fw-bold mb-0">Registration</span>
        </div>
        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
            Enter your details to register
        </h5>
        <div class="input-group form-outline mb-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-signature"></span>
                    </div>
                </div>
            </div>
            @error('name')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group form-outline mb-2">
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group form-outline mb-2">
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="on">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group form-outline mb-2">
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Confirm password" name="confirmPassword"
                    autocomplete="on">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('confirmPassword')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="pt-1 mb-4">
            <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
        </div>
    </form>
@endsection
