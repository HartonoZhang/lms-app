@extends('layouts.template')

@section('title')
    Welcome to The Dashboard, {{ Auth::user()->name }}!
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-graduation-cap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Student</span>
                        <span class="info-box-number">{{ count($listStudent) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-chalkboard-teacher"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Teacher</span>
                        <span class="info-box-number">{{ count($listTeacher) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-chalkboard"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Classes</span>
                        <span class="info-box-number">{{ count($listClassroom) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-book-reader"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Courses</span>
                        <span class="info-box-number">{{ count($listCourses) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <section class="col-md-8 connectedSortable">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Student Statistics</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="studentData"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-md-4 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Other</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </section>
        </div>
        <div class="row">
            <section class="col-md-8 connectedSortable">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Teacher Statistics</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="teacherData"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection

@section('js-script')
    <!-- ChartJS -->
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script>
        $(function() {
            $('.connectedSortable').sortable({
                placeholder: 'sort-highlight',
                connectWith: '.connectedSortable',
                handle: '.card-header, .nav-tabs',
                forcePlaceholderSize: true,
                zIndex: 999999
            })
            $('.connectedSortable .card-header').css('cursor', 'move')

            var studentsGraph = @json($studentChartByYear);
            var graduatedStudentGraph = @json($graduatedStudentByYear);
            var studentsGraphLabel = studentsGraph.map(element => 'Year ' + element.year);
            var studentsGraphData = studentsGraph.map(element => {
                let graduatedData = graduatedStudentGraph.find(data => data.year === element.year)
                if (graduatedStudentGraph.find(data => data.year === element.year)) {
                    return {
                        count: element.count,
                        graduated: graduatedData.graduated
                    }
                }
                return {
                    count: element.count
                }
            });
            var studentChartData = {
                labels: studentsGraphLabel,
                datasets: [{
                        label: 'New Student',
                        backgroundColor: '#7d8da1',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: studentsGraphData.map(data => data.count)
                    },
                    {
                        label: 'Graduated Student',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: studentsGraphData.map(data => data.graduated)
                    },
                ]
            }
            var barChartCanvasStudent = $('#studentData').get(0).getContext('2d')
            var barChartDataStudent = $.extend(true, {}, studentChartData)
            var temp0 = studentChartData.datasets[0]
            barChartDataStudent.datasets[0] = temp0

            var barChartOptionsStudent = {
                title: {
                    display: true,
                    text: `Students Data Last 5-Year`
                },
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

            new Chart(barChartCanvasStudent, {
                type: 'bar',
                data: barChartDataStudent,
                options: barChartOptionsStudent
            })

            var teachersGraph = @json($teacherChartByYear);
            var teachersGraphLabel = teachersGraph.map(element => 'Year ' + element.year);
            var teachersGraphData = teachersGraph.map(element => element.count);
            var TeacherChartData = {
                labels: teachersGraphLabel,
                datasets: [{
                    label: 'Total Teacher',
                    backgroundColor: '#41f1b6',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: teachersGraphData
                }]
            }

            var barChartCanvasTeacher = $('#teacherData').get(0).getContext('2d')
            var barChartDataTeacher = $.extend(true, {}, TeacherChartData)
            var temp0 = TeacherChartData.datasets[0]
            barChartDataTeacher.datasets[0] = temp0

            var barChartOptionsTeacher = {
                title: {
                    display: true,
                    text: `Teachers Data Last 5-Year`
                },
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

            new Chart(barChartCanvasTeacher, {
                type: 'horizontalBar',
                data: barChartDataTeacher,
                options: barChartOptionsTeacher
            })

        })
    </script>
@endsection
