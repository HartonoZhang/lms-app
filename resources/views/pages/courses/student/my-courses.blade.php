@extends('layouts.template')

@section('title', 'My Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">My Courses</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            @foreach ($classrooms as $item)
                <div class="col-md-4 col-sm-6 col-12">
                    <a href={{ route('student-course-detail', $item->id) }}>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    {{ $item->course->name }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text my-0">{{ $item->code }} - {{ $item->name }}</p>
                                <p class="card-text my-0">{{ count($item->studentClassroom) }} Students</p>
                            </div>
                            <div class="card-footer">
                                @php
                                    $date_now = new DateTime();
                                    $progressbarPercent = '0%';
                                    $totalSession = count($item->sessions);
                                    $sessionDone = 0;
                                    if ($totalSession) {
                                        foreach ($item->sessions as $value) {
                                            if ($value->end_time < $date_now) {
                                                $sessionDone++;
                                            }
                                        }
                                        $progressbarPercent =
                                            sprintf('%.0f', ($sessionDone * 100) / $totalSession) . '%';
                                    }
                                @endphp
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="progress progress-xs rounded w-100">
                                        <div class="progress-bar {{ $progressbarPercent === '100%' ? 'bg-success' : 'bg-warning' }} progress-bar-striped progress-bar-animated"
                                            role="progressbar" style="width: {{ $progressbarPercent }}" aria-valuenow="100"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="ml-2">{{ $progressbarPercent }}</span>
                                </div>
                                <p class="card-subtitle text-muted">{{ $sessionDone }} out of {{ $totalSession }} sessions completed</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('css-link')

    <style>
        .card:hover {
            transform: scale(1.04);
            transition: 0.2s ease-in-out;
        }
    </style>
@endsection

@section('js-script')

    <script type="text/javascript"></script>
@endsection
