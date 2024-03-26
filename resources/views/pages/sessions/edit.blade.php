@extends('layouts.template')

@section('title', 'Update Session')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course') }}">My Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-course-detail', $classroom->id) }}">Courses Detail</a></li>
    <li class="breadcrumb-item active">Update Session</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Session Infomation
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action={{ route('update-session', $session->id) }} method="POST"
                    enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="title" class="form-control form-control-mb"
                                    placeholder="Title" name="title" value="{{ old('title', $session->title) }}" />
                                <label for="title">Title*</label>
                            </div>
                            @error('title')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="classroom" class="form-control form-control-mb"
                                    placeholder="Classroom" value="{{ $classroom->name }}" readonly />
                                <label for="classroom">Classroom*</label>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <textarea id="description" class="form-control form-control-mb" placeholder="Description" name="description"
                                    rows="3">{{ old('description', $session->description) }}</textarea>
                                <label for="description">Description*</label>
                            </div>
                            @error('description')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="datetime-local" id="start_time" class="form-control form-control-mb"
                                    placeholder="Start Time" name="start_time" value="{{ old('start_time', $session->start_time) }}" />
                                <label for="start_time">Start Time*</label>
                            </div>
                            @error('start_time')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="datetime-local" id="end_time" class="form-control form-control-mb"
                                    placeholder="End Time" name="end_time" value="{{ old('end_time', $session->end_time) }}" />
                                <label for="end_time">End Time*</label>
                            </div>
                            @error('end_time')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a type="button" href="{{ route('teacher-course-detail', $classroom->id) }}"
                        class="btn btn-danger">Cancel</a>
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
