@extends('layouts.template')

@section('title', 'Daily Quest')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student-quest') }}">Daily Quest</a></li>
    <li class="breadcrumb-item active">Daily Quest</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        @if ($questionAnswer->status === 'Correct')
            <div class="alert alert-success alert-dismissible">
                <h5><i class="icon fas fa-check"></i> Good Job!</h5>
                Your answer is correct
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-times"></i> Try Again next time</h5>
                Your answer is incorrect
            </div>
        @endif
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
                @if ($questionAnswer->status === 'Correct')
                    <div class="boxed-check-group boxed-check-success">
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="checkbox" name="option" disabled
                                {{ $question->answer1 === $questionAnswer->answer ? 'checked' : '' }}>
                            <div class="boxed-check-label">A. {{ $question->answer1 }}</div>
                        </label>
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="checkbox" name="option" disabled
                                {{ $question->answer2 === $questionAnswer->answer ? 'checked' : '' }}>
                            <div class="boxed-check-label">B. {{ $question->answer2 }}</div>
                        </label>
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="checkbox" name="option" disabled
                                {{ $question->answer3 === $questionAnswer->answer ? 'checked' : '' }}>
                            <div class="boxed-check-label">C. {{ $question->answer3 }}</div>
                        </label>
                        <label class="boxed-check">
                            <input class="boxed-check-input" type="checkbox" name="option" disabled
                                {{ $question->answer4 === $questionAnswer->answer ? 'checked' : '' }}>
                            <div class="boxed-check-label">D. {{ $question->answer4 }}</div>
                        </label>
                    </div>
                @else
                    @if ($question->answer1 === $question->correct_answer)
                        <div class="boxed-check-group boxed-check-success">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">A. {{ $question->answer1 }}</div>
                            </label>
                        </div>
                    @elseif ($question->answer1 === $questionAnswer->answer)
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">A. {{ $question->answer1 }}</div>
                            </label>
                        </div>
                    @else
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" disabled>
                                <div class="boxed-check-label">A. {{ $question->answer1 }}</div>
                            </label>
                        </div>
                    @endif
                    @if ($question->answer2 === $question->correct_answer)
                        <div class="boxed-check-group boxed-check-success">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">B. {{ $question->answer2 }}</div>
                            </label>
                        </div>
                    @elseif ($question->answer2 === $questionAnswer->answer)
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">B. {{ $question->answer2 }}</div>
                            </label>
                        </div>
                    @else
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" disabled>
                                <div class="boxed-check-label">B. {{ $question->answer2 }}</div>
                            </label>
                        </div>
                    @endif
                    @if ($question->answer3 === $question->correct_answer)
                        <div class="boxed-check-group boxed-check-success">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">C. {{ $question->answer3 }}</div>
                            </label>
                        </div>
                    @elseif ($question->answer3 === $questionAnswer->answer)
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">C. {{ $question->answer3 }}</div>
                            </label>
                        </div>
                    @else
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" disabled>
                                <div class="boxed-check-label">C. {{ $question->answer3 }}</div>
                            </label>
                        </div>
                    @endif
                    @if ($question->answer4 === $question->correct_answer)
                        <div class="boxed-check-group boxed-check-success">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">D. {{ $question->answer4 }}</div>
                            </label>
                        </div>
                    @elseif ($question->answer4 === $questionAnswer->answer)
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" checked disabled>
                                <div class="boxed-check-label">D. {{ $question->answer4 }}</div>
                            </label>
                        </div>
                    @else
                        <div class="boxed-check-group boxed-check-danger">
                            <label class="boxed-check">
                                <input class="boxed-check-input" type="checkbox" name="option" disabled>
                                <div class="boxed-check-label">D. {{ $question->answer4 }}</div>
                            </label>
                        </div>
                    @endif
                @endif
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('student-quest') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/boxed-check/boxed-check.min.css">
    <style>
        .boxed-check-group.boxed-check-success .boxed-check .boxed-check-input:checked+.boxed-check-label {
            background-color: var(--color-success-dark);
        }

        .boxed-check-group.boxed-check-danger .boxed-check .boxed-check-input:checked+.boxed-check-label {
            background-color: var(--color-danger);
        }

        .boxed-check-group .boxed-check .boxed-check-input:checked+.boxed-check-label::before {
            content: none;
        }

        .boxed-check-group .boxed-check .boxed-check-input:disabled+.boxed-check-label {
            opacity: 1;
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
