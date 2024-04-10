@extends('layouts.template')

@section('title', 'Welcome to The Dashboard, Student!')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-chalkboard"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">My Class</span>
                        <span class="info-box-number">{{ count($myClass) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-globe"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">My Post</span>
                        <span class="info-box-number">{{ count($myPost) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">My Task</span>
                        <span class="info-box-number">{{ count($taskSubmitted) }} / {{ $totalTask }} </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">93,139</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <section class="col-md-8">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">My Progress</h3>
                            </div>
                            <div class="col-md-6 mr-0">
                                @if (count($periods))
                                    <form class="form-horizontal" action="{{ route('student-dashboard') }}" method="GET"
                                        enctype="multipart/form-data">
                                        <div class="form-row justify-content-between">
                                            <div class="form-label-group in-border mb-1" style="width: 100%">
                                                <select id="period" onchange="periodChange()"
                                                    class="form-control form-control-mb select2" style="width: 100%;"
                                                    name="period">
                                                    @foreach ($periods as $period)
                                                        <option value={{ $period->id }}
                                                            {{ old('period') == $period->id ? 'selected' : '' }}>
                                                            {{ $period->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($periodClassrooms)
                            <div class="chartWrapper">
                                <div class="chartAreaWrapper">
                                    @php
                                        $dynamicHeight = 0;
                                        if (count($periodClassrooms) > 3) {
                                            $dynamicHeight = count($periodClassrooms) * 70;
                                        }
                                    @endphp
                                    <div class="chart">
                                        @if ($dynamicHeight)
                                            <canvas id="classData" style="height: {{ $dynamicHeight }}px"></canvas>
                                        @else
                                            <canvas id="classData" style="height: 250px"></canvas>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center flex-column" style="height: 270px">
                                <img src="{{ asset('assets') }}/images/icons/no-data.png" alt="no-data">
                                <p>No classroom/progress yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <section class="col-md-4">
                <div class="card mb-0 card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Upcomming Class</h3>
                    </div>
                    @if ($firstSchedule)
                        <div class="card-body">
                            <p class="mb-0 text-truncate font-weight-bold" style="font-size: 1.2rem">
                                {{ $firstSchedule->title }}</p>
                            <p class="pb-2 border-bottom text-truncate">{{ $firstSchedule->description }}</p>
                            <div class="row mb-2" style="font-size: 0.90rem">
                                <div class="col-md-6 mb-2">
                                    <p class="mb-1 font-weight-bold">Start Time: </p>
                                    {{ $firstSchedule->start_time->format('g:i A, d-m-Y') }}
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p class="mb-1 font-weight-bold">End Time: </p>
                                    {{ $firstSchedule->end_time->format('g:i A, d-m-Y') }}
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p class="mb-1 font-weight-bold">Delivery Mode:</p>
                                    {{ $firstSchedule->is_online ? 'Virtual Online' : 'Offline Class' }}
                                </div>
                            </div>
                            <div class="pt-2 border-top" style="font-size: 0.90rem">
                                <p class="mb-1 font-weight-bold">Zoom/Class</p>
                                @if ($firstSchedule->is_online)
                                    <a href="{{ $firstSchedule->value }}" target="_blank" class="btn btn-primary">Join
                                        Now</a>
                                @else
                                    {{ $firstSchedule->value }}
                                @endif
                            </div>

                        </div>
                    @else
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column" style="height: 270px">
                                <img src="{{ asset('assets') }}/images/icons/no-data.png" alt="no-data">
                                <p>No upcomming class yet</p>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
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

        .chartWrapper {
            position: relative;
        }

        .chartWrapper>canvas {
            position: absolute;
            left: 0;
            top: 0;
            pointer-events: none;
        }

        .chartAreaWrapper {
            max-height: 250px;
            overflow-y: scroll;
        }

        .chartBox {
            height: 40px !important;
        }
    </style>
@endsection

@section('js-script')
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>

    <script>
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

            var currentdate = new Date();
            var classroomGraph = @json($periodClassrooms);
            var classroomGraphLabel = classroomGraph.map(classroom => classroom.name);
            var labelProgressTop = classroomGraph[0].period.name;
            var classroomGraphData = classroomGraph.map((classroom) => {
                let sessions = classroom.sessions;
                if (sessions.length === 0) {
                    return 0;
                }
                let sessionDone = 0;
                for (let i = 0; i < sessions.length; i++) {
                    if (sessions[i].end_time < currentdate.toISOString()) {
                        sessionDone++;
                    }
                }
                return Math.round((sessionDone * 100) / sessions.length);
            })

            var classroomChartData = {
                labels: classroomGraphLabel,
                datasets: [{
                    label: labelProgressTop,
                    backgroundColor: '#f3797e',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#f3797e',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    barPercentage: 0.5,
                    data: classroomGraphData
                }]
            }

            var barChartCanvasClassroom = $('#classData').get(0).getContext('2d')
            var barChartDataClassroom = $.extend(true, {}, classroomChartData)
            var temp0 = classroomChartData.datasets[0]
            barChartDataClassroom.datasets[0] = temp0

            var barChartOptionsClassroom = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: true,
                        stacked: true,
                        ticks: {
                            min: 0,
                            max: 100,
                            stepSize: 20
                        }
                    }],
                    yAxes: [{
                        display: true,
                        stacked: true,
                        ticks: {
                            min: 0,
                            max: 100,
                            stepSize: 20
                        }
                    }]
                }
            }

            new Chart(barChartCanvasClassroom, {
                type: 'horizontalBar',
                data: barChartDataClassroom,
                options: barChartOptionsClassroom
            })
        })
    </script>
@endsection
