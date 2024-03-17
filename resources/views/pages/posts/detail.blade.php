@extends('layouts.template')

@section('title', 'Post Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Post Detail {{ $post->id }}</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card post">
            <div class="card-header pb-0">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm"
                        src="{{ asset('assets') }}/images/profile/{{ $post->user->image }}" alt="user image">
                    <span class="username">
                        @if ($post->user->role_id === 2)
                            <a
                                href="/teacher/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                        @else
                            <a
                                href="/student/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                        @endif
                        @if (Auth::user()->id === $post->user->id)
                            <a href="#" class="float-right btn-tool" data-toggle="modal" data-target="#modal-delete"
                                data-placement="top" title="Delete"><i class="fas fa-times"></i></a>
                            <a href="{{ route('post-update', $post->id) }}" class="float-right btn-tool mr-2"><i
                                    class="fa fa-edit"></i></a>
                        @endif
                    </span>
                    <span class="description">{{ $post->created_at->format('g:i A d-m-y') }}</span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comments ({{ count($comments) }})</h3>
            </div>
            <div class="card-body">
                <form class="mb-4" action={{ route('post-comment-create', $post->id) }} method="POST"
                    enctype="multipart/form-data" data-remote="true">
                    @csrf
                    <input class="form-control form-control-md" type="text" name="comment" placeholder="Type a comment">
                </form>
                @if (count($comments) == 0)
                    <p>There is no comment yet!</p>
                @else
                    @foreach ($comments as $item)
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                @if ($item->user->role_id === 3)
                                    <a href="/student/profile/{{ $item->user->id }}">
                                        <span class="direct-chat-name float-left">{{ $item->user->name }}</span>
                                    </a>
                                @else
                                    <a href="/teacher/profile/{{ $item->user->id }}">
                                        <span class="direct-chat-name float-left">{{ $item->user->name }}</span>
                                    </a>
                                @endif
                                <span
                                    class="direct-chat-timestamp float-right">{{ $item->created_at->format('g:i A, d-m-y') }}</span>
                            </div>
                            <img class="direct-chat-img"
                                src="{{ asset('assets') }}/images/profile/{{ $item->user->image }}"
                                alt="message user image">
                            <div class="direct-chat-text">
                                {{ $item->comment }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action={{ route('post-delete', $post->id) }} method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title">Remove Post</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to remove "{{ $post->title }}" post?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
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

        .card-text,
        .direct-chat-text {
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
