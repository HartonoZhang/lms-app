@extends('layouts.template')

@section('title', 'Daily Quest')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student-quest') }}">Daily Quest</a></li>
    <li class="breadcrumb-item active">Daily Quest</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $question->course->name }} Course - Dibuat oleh guru {{ $question->teacher->user->name }}
                </h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Question</h5>
                <p class="card-text">
                    {{ $question->question }}
                </p>
                <form class="form-horizontal" action="{{ route('validate-quest-answer', $question->id) }}" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="boxed-check-group boxed-check-primary">
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="radio" name="option" value="{{ $question->answer1 }}">
                            <div class="boxed-check-label">A. {{ $question->answer1 }}</div>
                        </label>
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="radio" name="option" value="{{ $question->answer2 }}">
                            <div class="boxed-check-label">B. {{ $question->answer2 }}</div>
                        </label>
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="radio" name="option" value="{{ $question->answer3 }}">
                            <div class="boxed-check-label">C. {{ $question->answer3 }}</div>
                        </label>
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="radio" name="option" value="{{ $question->answer4 }}">
                            <div class="boxed-check-label">D. {{ $question->answer4 }}</div>
                        </label>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('student-quest') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary ml-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/boxed-check/boxed-check.min.css">
    <style>
        .boxed-check-group.boxed-check-primary .boxed-check .boxed-check-input:checked+.boxed-check-label {
            background-color: var(--color-primary);
        }

        .boxed-check-group .boxed-check .boxed-check-input:checked+.boxed-check-label::before {
            content: none;
        }

        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: normal;
        }

        .boxed-check-label:hover {
            transition: 0.2s ease-in-out;
        }
    </style>
@endsection



@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <script>
        $(function() {
            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif
        });
    </script>
@endsection
