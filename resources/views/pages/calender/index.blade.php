@extends('layouts.template')

@section('title', 'My Calender')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">My Calender</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-2">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Events</h4>
                        </div>
                        <div class="card-body">
                            <!-- the events -->
                            <div class="p-2 bg-warning mb-2 rounded">Session</div>
                            @if(Auth::user()->role_id === 3)
                                <div class="p-2 bg-info rounded">Task</div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
@endsection


@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fullcalendar/main.css">
    <style>

    </style>
@endsection

@section('js-script')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('assets') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/fullcalendar/main.js"></script>
    <script type="text/javascript">
        $(function() {
            var roleName = @json(strtolower(Auth::user()->role->name));
            var listSession = @json($listSession);
            var listTask = @json($listTask);
            
            var listSessionEvent = listSession.map(session => {
                return {
                    title: session.course + ' - ' + session.title,
                    start: session.start_time,
                    end: session.end_time,
                    backgroundColor: '#ffbb55',
                    url: `/${roleName}/course/${session.classroom_id}?session=${session.id}`
                }
            })

            var listTaskEvent = listTask.map(task => {
                return {
                    title: task.course + ' - ' + task.title,
                    start: task.created_at,
                    end: task.deadline,
                    backgroundColor: '#7d8da1',
                    url: `/${roleName}/course/${task.classroom_id}/assignment`
                }
            })

            var listEventMerged = [...listSessionEvent, ...listTaskEvent];

            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: listEventMerged,
                editable: false,
                droppable: false
            });

            calendar.render();
        })
    </script>
@endsection
