@extends('layouts.template')

@section('title', 'Post Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Post Detail</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                {{ $post }}
                <br>
                <h3 class="card-title">Create New Post</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <style>
        .card-body .card-title {
            font-weight: 600;
        }
        .card-text {
            font-size: 0.87rem !important;
        }
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
