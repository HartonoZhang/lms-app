@extends('layouts.template')

@section('title', 'Posts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('post-detail', $post->id) }}">Post Detail {{ $post->id }}</a></li>
    <li class="breadcrumb-item active">Update Post</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Post</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action={{ route('post-update', $post->id) }} method="POST"
                            enctype="multipart/form-data" data-remote="true">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title *</label>
                                <input type="text" id="title" class="form-control" name="title"
                                    value="{{ old('title', $post->title) }}" placeholder="Input title">
                                @error('title')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description *</label>
                                <textarea id="description" class="form-control" name="description" rows="3" placeholder="Input description">{{ old('description', $post->description) }}</textarea>
                                @error('description')
                                    <p class="text-danger mt-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <style>

    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
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
