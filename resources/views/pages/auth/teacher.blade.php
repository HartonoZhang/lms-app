@extends('layouts.auth')

@section('sub-title')
    Sign into your <span class="badge badge-secondary">Teacher</span> account
@endsection

@section('sign-in-as')
    <a class="btn btn-info btn-block" href="/admin/signin" role="button">
        Login as Admin</a>
    <a class="btn btn-primary btn-block" href="/student/signin" role="button">
        Login as Student
    </a>
@endsection
