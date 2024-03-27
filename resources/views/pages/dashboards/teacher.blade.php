@extends('layouts.template')

@section('title')
    Welcome to The {{ $organization->name }}, {{ Auth::user()->name }}!
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-chalkboard"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Class</span>
                        <span class="info-box-number">{{ count($teacherClassroom) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-globe"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Post</span>
                        <span class="info-box-number">{{ count($teacherPost) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-exclamation-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Question</span>
                        <span class="info-box-number">{{ count($teacherQuestion) }}</span>
                    </div>
                </div>
            </div>
            @php
                $isChecked = false;
                $totalStudent = 0;
                foreach ($teacherClassroom as $classroom) {
                    $totalStudent += count($classroom->classroom->studentClassroom);
                }
            @endphp
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-graduation-cap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Student</span>
                        <span class="info-box-number">{{ $totalStudent }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
@endsection

@section('js-script')
@endsection
