@extends('layouts.auth')

@section('sub-title')
    Sign into your <span class="badge badge-secondary">Student</span> account
@endsection

@section('sign-in-as')
    <a class="btn btn-primary btn-block" style="background-color: #55acee" href="/admin/signin" role="button">
        Login as Admin</a>
    <a class="btn btn-primary btn-block" style="background-color: #3b5998" href="/teacher/signin" role="button">
        Login as Teacher
    </a>
@endsection
