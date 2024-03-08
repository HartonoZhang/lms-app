@extends('layouts.template')

@section('title', 'Add Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Add Courses</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Course Information
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="/admin/add-student" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="firstName" class="form-control form-control-mb"
                                    placeholder="First Name" />
                                <label for="firstName">Course Code*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" />
                                <label for="lastName">Course Name*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="phoneNumber" class="form-control form-control-mb"
                                    placeholder="Phone Number" />
                                <label for="phoneNumber">Minimun Score*</label>
                            </div>
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

    <style>
        label {
            font-weight: 400 !important;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
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
