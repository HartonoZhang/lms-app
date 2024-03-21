@extends('layouts.template')

@section('title', 'List Posts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">List Posts</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('post-create-view') }}" class="btn btn-primary">
                Create Post
            </a>
            @if (Auth::user()->role_id === 1)
                <a href="{{ route('post-report-view') }}" class="btn btn-danger ml-2">
                    View Report
                </a>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                @foreach ($posts as $item)
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="{{ asset('assets') }}/images/profile/{{ $item->user->image }}" alt="user image">
                            <span class="username d-flex align-items-center">
                                @if ($item->user->role_id === 1)
                                    {{ $item->user->name }} <span class="badge text-white ml-1"
                                        style="background-color: #f3797e">Admin</span>
                                @elseif($item->user->role_id === 2)
                                    {{ $item->user->name }} <span class="badge text-white ml-1"
                                        style="background-color: #ffbb55">Teacher</span>
                                @else
                                    {{ $item->user->name }} <span class="badge text-white ml-1"
                                        style="background-color: #7380ec">Student</span>
                                @endif
                            </span>
                            <span class="description">{{ $item->created_at->format('g:iA, d-m-y') }}</span>
                        </div>
                        <a href="{{ route('post-detail', $item->id) }}">
                            <h6>{{ $item->title }}</h6>
                        </a>
                        <p class="post-description">
                            {{ $item->description }}
                        </p>

                        <p class="d-flex justify-content-end">
                            <a href="{{ route('post-detail', $item->id) }}" class="text-sm">
                                <i class="far fa-comments mr-1"></i> Comments
                                ({{ count($item->comment) }})
                            </a>
                        </p>
                    </div>
                @endforeach
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

    <style>
        .page-item.active .page-link {
            background-color: var(--color-primary);
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
