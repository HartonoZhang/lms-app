@extends('layouts.auth', ['organization' => $organization])

@section('sub-title')
    Sign into your <span class="badge badge-secondary">Admin</span> account
@endsection

@section('sign-in-as')
    <a class="btn btn-info btn-block" href="/teacher/signin" role="button">
        Login as Teacher
    </a>
    <a class="btn btn-primary btn-block" href="/student/signin" role="button">
        Login as Student
    </a>
@endsection
