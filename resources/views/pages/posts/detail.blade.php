@extends('layouts.template')

@section('title', 'Post Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('post-list') }}">List Posts</a></li>
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
                        <div class="d-flex align-items-center">
                            @if ($post->user->role_id === 2)
                                <a href="/teacher/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                                <span class="badge text-white ml-1" style="background-color: #ffbb55">Teacher</span>
                            @elseif ($post->user->role_id === 3)
                                <a href="/student/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                                <span class="badge text-white ml-1" style="background-color: #7380ec">Student</span>
                            @else
                                {{ $post->user->name }} <span class="badge text-white ml-1"
                                    style="background-color: #f3797e">Admin</span>
                            @endif
                        </div>
                        @if (Auth::user()->id === $post->user->id)
                            <a href="#" class="float-right btn-tool" data-toggle="modal" data-target="#modal-delete"
                                data-placement="top" title="Delete"><i class="fas fa-times"></i></a>
                            <a href="{{ route('post-update', $post->id) }}" class="float-right btn-tool mr-2"><i
                                    class="fa fa-edit"></i></a>
                            @if ($post->user->role_id !== 1)
                                @if (count($reports) === 0)
                                    <a href="#" class="float-right btn-tool mr-2" data-toggle="tooltip"
                                        data-placement="top" title="No users reported this post."><i
                                            class="fas fa-exclamation-triangle"></i></a>
                                @elseif(count($reports) === 1)
                                    <a href="#" class="float-right btn-tool mr-2" data-toggle="tooltip"
                                        data-placement="top" title="1 user reported this post."><i
                                            class="fas fa-exclamation-triangle"></i></a>
                                @else
                                    <a href="#" class="float-right btn-tool mr-2" data-toggle="tooltip"
                                        data-placement="top"
                                        title="There are {{ count($reports) }} users who reported this post."><i
                                            class="fas fa-exclamation-triangle"></i></a>
                                @endif
                            @endif
                        @elseif ($post->user->role_id !== 1 && Auth::user()->role_id !== 1)
                            <a href="#" class="float-right btn-tool" data-toggle="modal" data-target="#modal-report"
                                data-placement="top" title="Report"><i class="fas fa-exclamation-triangle"></i></a>
                        @endif
                    </span>
                    <span class="description">{{ $post->created_at->format('g:i A d-m-y') }}</span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-2">{{ $post->title }}</h5>
                <div class="row mb-2">
                    @if ($post->image)
                        <div class="image-area col-md-6">
                            <img src="{{ asset('assets') }}/images/posts/image/{{ $post->image }}" alt="image-1"
                                class="img-fluid">
                        </div>
                    @endif
                    @if ($post->image_2)
                        <div class="image-area col-md-6">
                            <img src="{{ asset('assets') }}/images/posts/image_2/{{ $post->image_2 }}" alt="image-2"
                                class="img-fluid">
                        </div>
                    @endif
                </div>
                <p class="card-text">{{ $post->description }}</p>
                @if ($post->link || $post->link_2)
                    <p class="card-text">
                        @if ($post->link)
                            <a href="{{ $post->link }}" target="_blank">{{ $post->link }}</a> <br>
                        @endif
                        @if ($post->link_2)
                            <a href="{{ $post->link_2 }}" target="_blank">{{ $post->link_2 }}</a>
                        @endif
                    </p>
                @endif
                @if ($post->file)
                    <p class="card-text">
                        <a href="{{ asset('assets/images/posts/file') }}/{{ $post->file }}"
                            target="_blank">{{ $post->file }}</a>
                    </p>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comments ({{ count($comments) }})</h3>
            </div>
            <div class="card-body">
                @if (Auth::user()->role_id !== 1)
                    <form class="mb-4" action={{ route('post-comment-create', $post->id) }} method="POST"
                        enctype="multipart/form-data" data-remote="true">
                        @csrf
                        <div class="input-group">
                            <input class="form-control form-control-md" type="text" name="comment"
                                placeholder="Type a comment">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-primary rounded-right">Send</button>
                            </div>
                        </div>
                    </form>
                @endif
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

    <div class="modal fade" id="modal-report">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action={{ route('post-report', $post->id) }} method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">Report Post</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Why would you like to report this "{{ $post->title }}" post?</p>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" id="abusive" type="radio" name="report"
                                    value="This is abusive or harmful" checked>
                                <label class="form-check-label" for="abusive">This is abusive or harmful</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="private-info" type="radio"
                                    value="This contains private information" name="report">
                                <label class="form-check-label" for="private-info">This contains private
                                    information</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"id="break-rule" type="radio"
                                    value="This break community/organization rules" name="report">
                                <label class="form-check-label" for="break-rule">This break community/organization
                                    rules</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="other" type="radio" value="Other issues"
                                    name="report">
                                <label class="form-check-label" for="other">Other issues</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send</button>
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
            $('[data-toggle="tooltip"]').tooltip()

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
