@extends('layouts.auth')

@section('sub-title')
    Sign into your <span class="badge badge-secondary">Admin</span> account
@endsection

@section('sign-in-as')
    <a class="btn btn-primary btn-block" style="background-color: #55acee" href="/teacher/signin" role="button">
        Login as Teacher
    </a>
    <a class="btn btn-primary btn-block" style="background-color: #3b5998" href="/student/signin" role="button">
        Login as Student
    </a>
@endsection
