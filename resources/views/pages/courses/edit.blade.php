@extends('layouts.template')

@section('title', 'Edit Course')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Edit Course</li>
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
                <form class="form-horizontal" action={{route('course-update',$data->id)}} method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="firstName" class="form-control form-control-mb"
                                    placeholder="First Name" name="course_code" value="{{old('course_code') ? old('course_code') : $data->code}}"/>
                                <label for="firstName">Course Code*</label>
                            </div>
                            @error('course_code')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" name="course_name" value="{{old('course_name') ? old('course_name') : $data->name}}"/>
                                <label for="lastName">Course Name*</label>
                            </div>
                            @error('course_name')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="phoneNumber" class="form-control form-control-mb"
                                    placeholder="Phone Number" name="min_score" value="{{old('min_score') ? old('min_score') : $data->min_score}}"/>
                                <label for="phoneNumber">Minimun Score*</label>
                            </div>
                            @error('min_score')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
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
