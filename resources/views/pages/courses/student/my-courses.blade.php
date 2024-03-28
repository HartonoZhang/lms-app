@extends('layouts.template')

@section('title', 'My Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">My Courses</li>
@endsection

@section('content')
    @if ($periods->all() == null)
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    Error : You don't have any registered classroom
                </h3>
            </div>
            <div class="card-body">
                <p class="card-text">Please contact admin for the help</p>   
            </div>
        </div>  
    @else
        <div class="container-fluid h-100">
            <form class="form-horizontal" action="{{ route('student-course') }}" method="GET" enctype="multipart/form-data">
                <div class="form-row justify-content-between">
                    <div class="col-sm-4 mb-3">
                        <div class="form-label-group in-border mb-1">
                            <select id="period" onchange="periodChange()" class="form-control form-control-mb select2" style="width: 100%;"
                                name="period">
                                @foreach ($periods as $period)
                                    <option value={{ $period->id }} {{ old('period') == $period->id ? 'selected' : '' }}>
                                        {{ $period->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
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
                                    <p class="card-subtitle text-muted">{{ $sessionDone }} out of {{ $totalSession }}
                                        sessions
                                        completed</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@section('css-link')
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

        .card:hover {
            transform: scale(1.04);
            transition: 0.2s ease-in-out;
        }
    </style>
@endsection

@section('js-script')
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>

    <script type="text/javascript">
        function periodChange() {
            let queryString = window.location.search;
            let params = new URLSearchParams(queryString);
            params.delete('period');
            params.append('period', document.getElementById("period").value);
            document.location.href = "?" + params.toString();
        }

        $(function() {
            $('select').select2({
                theme: 'bootstrap4',
            });
        })
    </script>
@endsection
