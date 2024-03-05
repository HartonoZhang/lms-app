@extends('pages.layouts.app')

@section('content')
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="{{ asset('assets') }}/img/login.png" alt="login form" class="img-fluid"
                            style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <form method="POST" action="/signin" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                    <span class="h1 fw-bold mb-0">Logo</span>
                                </div>
                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                    account</h5>
                                @if (Session::get('status') == 'success')
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @elseif (Session::has('status') == 'failed')
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <div class="input-group form-outline mb-4">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email">
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
                                <div class="input-group form-outline mb-4">
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password"
                                            autocomplete="on">
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
                                <div class="pt-1 mb-4">
                                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                </div>
                                <a class="small text-muted" href="#!">Login as admin</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
