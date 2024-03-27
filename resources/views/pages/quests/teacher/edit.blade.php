@extends('layouts.template')

@section('title', 'Update Question')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-quest') }}">Daily Quest</a></li>
    <li class="breadcrumb-item active">Update Question</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Question Information
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action={{ route('update-question', $question->id) }} method="POST"
                    enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" class="form-control form-control-mb" placeholder="Teacher"
                                    name="teacher_id" value="{{ $teacher->id }}" hidden />
                                <input type="text" id="teacher" class="form-control form-control-mb"
                                    placeholder="Teacher" name="teacher" value="{{ $teacher->user->name }}" readonly />
                                <label for="teacher">Teacher*</label>
                            </div>
                            @error('teacher_id')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="course_id">
                                    <option disabled selected>Select a course</option>
                                    @foreach ($listCourse as $course)
                                        @if ($course->id === $question->course_id)
                                            <option value="{{ $course->id }}" selected>
                                                {{ $course->name }} </option>
                                        @else
                                            <option value="{{ $course->id }}">
                                                {{ $course->name }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="course_id">Course*</label>
                            </div>
                            @error('course_id')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <textarea id="question" class="form-control form-control-mb" placeholder="Question" name="question" rows="3">{{ old('question', $question->question) }}</textarea>
                                <label for="question">Question*</label>
                            </div>
                            @error('question')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer1" class="form-control form-control-mb"
                                    placeholder="Answer 1" name="answer1" value="{{ old('answer1', $question->answer1) }}" />
                                <label for="answer1">Answer 1*</label>
                            </div>
                            @error('answer1')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer2" class="form-control form-control-mb"
                                    placeholder="Answer 2" name="answer2" value="{{ old('answer2', $question->answer2) }}" />
                                <label for="answer2">Answer 2*</label>
                            </div>
                            @error('answer2')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer3" class="form-control form-control-mb"
                                    placeholder="Answer 3" name="answer3" value="{{ old('answer3', $question->answer3) }}" />
                                <label for="answer3">Answer 3*</label>
                            </div>
                            @error('answer3')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer4" class="form-control form-control-mb"
                                    placeholder="Answer 4" name="answer4" value="{{ old('answer4', $question->answer4) }}" />
                                <label for="answer4">Answer 4*</label>
                            </div>
                            @error('answer4')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="correct_answer" class="form-control form-control-mb"
                                    placeholder="Corret Answer" name="correct_answer"
                                    value="{{ old('correct_answer', $question->correct_answer) }}" />
                                <label for="correct_answer">Corret Answer*</label>
                            </div>
                            <small id="correct_answer_help" class="form-text text-muted">Please copy paste the correct
                                answer from one of the 4 answers above (example answer 2: 25, then fill in 25)</small>
                            @error('correct_answer')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a type="button" href="{{ route('teacher-quest') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    <style>
        .select2-container--bootstrap4.select2-container--focus .select2-selection {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection {
            -webkit-transition: none !important;
        }

        label {
            font-weight: 400 !important;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('select').select2({
                theme: 'bootstrap4',
            });

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
