@extends('layouts.template')

@section('title', 'Create Question')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-quest') }}">Daily Quest</a></li>
    <li class="breadcrumb-item active">Create Question</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Question
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action={{ route('create-question') }} method="POST"
                    enctype="multipart/form-data" data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" class="form-control form-control-mb"
                                    placeholder="Teacher" name="teacher_id" value="{{ $teacher->id }}"
                                    hidden />
                                <input type="text" id="teacher" class="form-control form-control-mb"
                                    placeholder="Teacher" name="teacher" value="{{ $teacher->user->name }}"
                                    readonly />
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
                                        <option value="{{ $course->id }}">{{ $course->name }} </option>
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
                                <textarea id="question" class="form-control form-control-mb" placeholder="Question" name="question" rows="3"></textarea>
                                <label for="question">Question*</label>
                            </div>
                            @error('question')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer_1" class="form-control form-control-mb"
                                    placeholder="Answer 1" name="answer_1" />
                                <label for="answer_1">Answer 1*</label>
                            </div>
                            @error('answer_1')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer_2" class="form-control form-control-mb"
                                    placeholder="Answer 2" name="answer_2" />
                                <label for="answer_2">Answer 2*</label>
                            </div>
                            @error('answer_2')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer_3" class="form-control form-control-mb"
                                    placeholder="Answer 3" name="answer_3" />
                                <label for="answer_3">Answer 3*</label>
                            </div>
                            @error('answer_3')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="answer_4" class="form-control form-control-mb"
                                    placeholder="Answer 4" name="answer_4" />
                                <label for="answer_4">Answer 4*</label>
                            </div>
                            @error('answer_4')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="correct_answer" class="form-control form-control-mb"
                                    placeholder="Corret Answer" name="correct_answer" />
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
                    <button type="submit" class="btn btn-primary">Create</button>
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
