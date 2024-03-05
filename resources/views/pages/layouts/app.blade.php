<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login</title>
    <link rel="shortcut icon" href="{{ URL::to('assets/img/favicon.png') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">

    <style>
        hr.hr-text {
            position: relative;
            border: none;
            height: 1px;
            background: #999;
        }

        hr.hr-text::before {
            content: attr(data-content);
            display: inline-block;
            background: #fff;
            font-weight: bold;
            font-size: 0.85rem;
            color: #999;
            border-radius: 30rem;
            padding: 0.2rem 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
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
                                    <form method="POST" action="/signin/{{ $role }}"
                                        enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" name="role" value="1" hidden>
                                        <div class="input-group form-outline mb-4">
                                            <div class="input-group">
                                                <input type="email" class="form-control" placeholder="Email"
                                                    name="email">
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
                                                <input type="password" class="form-control" placeholder="Password"
                                                    name="password" autocomplete="on">
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
                                            <button class="btn btn-dark btn-block" type="submit">Login</button>
                                        </div>
                                        <hr data-content="OR" class="hr-text mb-4">
                                        @yield('sign-in-as')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
