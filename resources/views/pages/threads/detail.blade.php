@extends('layouts.template')

@section('title', 'Thread Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}/course">My Courses</a></li>
    <li class="breadcrumb-item active"><a href="/{{ strtolower(Auth::user()->role->name) }}/course/{{$session->classroom_id}}">Courses Detail</a></li>
    <li class="breadcrumb-item active">Thread Detail</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card post">
            <div class="card-header pb-0">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm"
                        src="{{ asset('assets') }}/images/profile/{{ $thread->user->image }}" alt="user image">
                    <span class="username">
                        <div class="d-flex align-items-center">
                            @if ($thread->user->role_id === 2)
                                <a href="/teacher/profile/{{ $thread->user->id }}">{{ $thread->user->name }}</a>
                                <span class="badge text-white ml-1" style="background-color: #ffbb55">Teacher</span>
                            @elseif ($thread->user->role_id === 3)
                                <a href="/student/profile/{{ $thread->user->id }}">{{ $thread->user->name }}</a>
                                <span class="badge text-white ml-1" style="background-color: #7380ec">Student</span>
                            @endif
                        </div>
                        @if (Auth::user()->id === $thread->user->id)
                            <a href="#" class="float-right btn-tool" data-toggle="modal" data-target="#modal-delete"
                                data-placement="top" title="Delete"><i class="fas fa-times"></i></a>
                            <a href="#" class="float-right btn-tool mr-2" data-toggle="modal"
                                data-target="#modal-edit" data-placement="top" title="Edit"><i
                                    class="fas fa-edit"></i></a>
                        @endif
                    </span>
                    <span class="description">{{ $thread->created_at->format('g:i A d-m-y') }}</span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-2">{{ $thread->title }}</h5>
                <p class="card-text">{{ $thread->description }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comments ({{ count($comments) }})</h3>
            </div>
            <div class="card-body">
                @if (Auth::user()->role_id !== 1)
                    <form class="mb-4" action={{ route('thread-comment-create', $thread->id) }} method="POST"
                        enctype="multipart/form-data" data-remote="true">
                        @csrf
                        <input class="form-control form-control-md" type="text" name="comment"
                            placeholder="Type a comment">
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
                                {{ $item->description }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Thread</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('thread-update', $thread->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group" data-input="title">
                            <label for="threadTitle">Title</label>
                            <input type="text" class="form-control" name="title" id="threadTitle"
                                placeholder="Thread Title" value="{{ old('title', $thread->title) }}">
                            @error('title')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" data-input="description">
                            <label for="threadDescription">Description</label>
                            <textarea type="text" class="form-control" name="description" id="threadDescription" placeholder="Thread Description"
                                rows="3">{{ old('description', $thread->description) }}</textarea>
                            @error('description')
                                <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action={{ route('thread-delete', ['thread' => $thread->id, 'session' => $thread->session_id]) }}
                    method="POST" enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title">Remove Thread</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to remove "{{ $thread->title }}" thread?</p>
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
            @if ($errors->any())
                @if (Session::has('failUpdateThread'))
                    $('#modal-edit').modal('show');
                @endif
            @endif

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
