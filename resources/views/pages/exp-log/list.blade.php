@extends('layouts.template')

@section('title', 'Exp History')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Exp History</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-body">
                @if (count($expLog))
                    @foreach ($expLog as $log)
                        <div class="post my-0 py-1">
                            <p class="post-description mb-0 font-weight-bold">
                                {{ $log->message }}
                            </p>
                            <span class="description">{{ $log->created_at->format('g:iA, d-m-y') }}</span>
                        </div>
                    @endforeach
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $expLog->links() }}
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('assets') }}/images/icons/no-data.png" alt="no-data">
                        <p> There are no exp history yet!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('css-link')
    <style>
        .description {
            font-size: 0.9rem;
        }

        .page-item.active .page-link {
            background-color: var(--color-primary);
        }
    </style>
@endsection

@section('js-script')
    <script type="text/javascript"></script>
@endsection
