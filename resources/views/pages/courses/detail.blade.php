@extends('layouts.template')

@section('title', 'Course Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher-courses') }}">Courses</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card course-detail-card overflow-hidden">
            <div class="course-detail-header px-4 pt-4 pb-2 d-flex flex-column justify-content-between">
                <div class="">
                    <h3>{{$class->name}}</h3>
                    <div class="mb-2">{{$class->code}}</div>
                    <div class="course-teacher-profile d-flex align-items-center" style="font-size: 0.8rem">
                        <div>
                            <img loading="lazy" src="{{ url('/assets/img/dummy_course.jpg') }}" alt="Teacher">
                        </div>
                        @foreach ($class->TeacherClassroom as $tc)
                            <div class="ml-2">
                                <p class="m-0">{{$tc->Teacher->name}}</p>
                                {{-- <p class="m-0">D1234 - Primary Instructor</p> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($userRole == 3)
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="progress progress-xs rounded w-100">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 33%" aria-valuenow="33" aria-valuemax="100"></div>
                        </div>
                        <span class="ml-2" style="font-size: 0.8rem">33%</span>
                    </div>
                @endif
                <div class="mt-3 mb-2 mx-0 px-0">
                    <a class="content-link mr-2 py-1 px-3 active" href="">Sessions</a>
                    <a class="content-link mr-2 py-1 px-3" href="">Assignments</a>
                    <a class="content-link mr-2 py-1 px-3" href="">People</a>
                    @if ($userRole == 3)
                        <a class="content-link mr-2 py-1 px-3" href="">Attendance</a>
                    @endif
                </div>
            </div>
            <div class="card-body course-detail-body py-2 px-2">
                <div class="row">
                    <div class="col-3 canvas-wrapper p-0 m-0">
                        <canvas id="session-roadmap" width="100" height="100"></canvas>
                    </div>
                    <div class="col-9 px-3">
                        <nav>
                            <div class="nav nav-tabs" role="tablist">
                                <button class="nav-link active" data-toggle="tab" data-target="#nav-description"
                                    type="button" role="tab" aria-controls="nav-description"
                                    aria-selected="true">Description</button>
                                <button class="nav-link" data-toggle="tab" data-target="#nav-learning-material"
                                    type="button" role="tab" aria-controls="nav-learning-material"
                                    aria-selected="false">Learning Material</button>
                                <button class="nav-link" data-toggle="tab" data-target="#nav-forum" type="button"
                                    role="tab" aria-controls="nav-forum" aria-selected="false">Forum</button>
                                @if ($userRole == 2)
                                    <button class="nav-link" data-toggle="tab" data-target="#nav-attendance" type="button"
                                        role="tab" aria-controls="nav-attendance" aria-selected="false">Attendance</button>
                                @endif
                            </div>
                        </nav>
                        <h3 class="my-2 pb-2">
                            {{-- isi custom content --}}
                            Session 1
                        </h3>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                aria-labelledby="nav-description-tab">
                                {{-- isi custom content --}}
                                Disini kita belajar membuat web laravel.
                                <br>
                                Learning points:
                                <ul>
                                    <li>pintar</li>
                                    <li>hebat</li>
                                    <li>sukses</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="nav-learning-material" role="tabpanel"
                                aria-labelledby="nav-learning-material-tab">
                                {{-- isi custom content --}}
                                <div class="row">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="col-6 py-2">
                                            <a class="material-link row mx-2 my-1 py-2 px-3" href="#">
                                                <div class="col-4">
                                                    <div class="link-icon-container">
                                                        <i class="fas fa-link"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8 d-flex flex-column justify-content-center align-items-">
                                                    <p class="p-0 m-0">Learning material 1</p>
                                                    <div>
                                                        <button class="btn btn-warning rounded-circle material-action-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger rounded-circle material-action-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endfor
                                    <div class="col-6 py-2">
                                        <a class="material-link row mx-2 my-1 py-2 px-3" href="#">
                                            <div class="col-4">
                                                <div class="link-icon-container">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                            </div>
                                            <div class="col-8 d-flex flex-column justify-content-center align-items-">
                                                <p class="p-0 m-0">File material 1</p>
                                                <div>
                                                    <button class="btn btn-warning rounded-circle material-action-btn">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger rounded-circle material-action-btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 py-2">
                                        <div class="material-link add-material row mx-2 my-1 py-2 px-3">
                                            <div class="col-4">
                                                <div class="link-icon-container">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="col-8 d-flex flex-column justify-content-center align-items-">
                                                <p class="p-0 m-0">Add more...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-forum" role="tabpanel" aria-labelledby="nav-forum-tab">
                                {{-- isi custom content --}}
                                <div class="forum-container">
                                    <div class="card card-widget border collapsed-card">
                                        <div class="card-header sticky-top">
                                            <div class="user-block">
                                                <img loading="lazy" class="img-circle" src="{{ url('/assets/img/dummy_course.jpg') }}"
                                                    alt="User Image">
                                                <span class="username">Jonathan Burke Jr.</span>
                                                <span class="description">13 March 2024, 12:13</span>
                                            </div>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <span class="float-right text-muted">2 comments</span>
                                        </div>
                                        {{-- post --}}
                                        <div class="card-body">
                                            <p>Far far away, behind the word mountains, far from the
                                                countries Vokalia and Consonantia, there live the blind
                                                texts. Separated they live in Bookmarksgrove right at</p>

                                            <p>the coast of the Semantics, a large language ocean.
                                                A small river named Duden flows by their place and supplies
                                                it with the necessary regelialia. It is a paradisematic
                                                country, in which roasted parts of sentences fly into
                                                your mouth.</p>
                                        </div>
                                        {{-- comments --}}
                                        <div class="card-footer card-comments">
                                            <div class="card-comment">
                                                <img loading="lazy" class="img-circle img-sm" src="{{ url('/assets/img/dummy_course.jpg') }}"
                                                    alt="User Image">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        Maria Gonzales
                                                        <span class="text-muted float-right">13 March 2024, 12:13</span>
                                                    </span>
                                                    It is a long established fact that a reader will be distracted
                                                    by the readable content of a page when looking at its layout.
                                                </div>
                                            </div>
                                            <div class="card-comment">
                                                <img loading="lazy" class="img-circle img-sm" src="{{ url('/assets/img/dummy_course.jpg') }}"
                                                    alt="User Image">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        Nora Havisham
                                                        <span class="text-muted float-right">13 March 2024, 12:13</span>
                                                    </span>
                                                    The point of using Lorem Ipsum is that it hrs a morer-less
                                                    normal distribution of letters, as opposed to using
                                                    'Content here, content here', making it look like readable English.
                                                </div>
                                            </div>
                                        </div>
                                        {{-- form --}}
                                        <div class="card-footer">
                                            <form action="#" method="post">
                                                <img loading="lazy" class="img-fluid img-circle img-sm"
                                                    src="{{ url('/assets/img/dummy_course.jpg') }}" alt="Alt Text">
                                                <div class="img-push">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Press enter to post comment">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-attendance" role="tabpanel"
                                aria-labelledby="nav-attendance-tab">
                                {{-- isi custom content --}}
                                <div class="my-3">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-5 my-1">
                                                <input type="text" class="mx-1 form-control" placeholder="Search Student Name..." />
                                            </div>
                                            <div class="col-md-5 my-1">
                                                <input type="text" class="mx-1 form-control" placeholder="Search Student Id..." />
                                            </div>
                                            <div class="col-md-2 my-1">
                                                <button class="mx-2 btn btn-primary float-right">Search</button>
                                            </div>
                                            <div class="col-md-12 my-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="attendanceFilter" id="filterAll" value="all" checked>
                                                    <label class="form-check-label" for="filterAll">All</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="attendanceFilter" id="filterPresent" value="present">
                                                    <label class="form-check-label" for="filterPresent">Present</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="attendanceFilter" id="filterNotPresent" value="notPresent">
                                                    <label class="form-check-label" for="filterNotPresent">Not Present</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="">
                                        <div class="attendance-list">
                                            <div class="row">
                                                @for ($i=1;$i<6;$i++)
                                                    <div class="col-lg-6 my-2">
                                                        <div class="student-attendance d-flex align-items-center justify-content-between rounded border px-2">
                                                            <div class="d-flex justify-content-start align-items-center">
                                                                <img loading="lazy" class="img-circle img-sm" src="{{ url('/assets/img/dummy_course.jpg') }}"
                                                                alt="User Image">
                                                                <div class="ml-2">
                                                                    <p class="mb-0">Kenneth Vincent Kwandou</p>
                                                                    <small class="text-muted">2440026780</small>
                                                                </div>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="student_{{$i}}" checked>
                                                                <label class="custom-control-label" for="student_{{$i}}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                        <button class="float-right btn btn-primary my-3 mx-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        /* .select2-container--bootstrap4.select2-container--focus .select2-selection {
                box-shadow: none !important;
            }

            .select2-container--bootstrap4 .select2-selection {
                -webkit-transition: none !important;
            }
            label {
                font-weight: 400 !important;
            } */

        :root {
            --courseColor: #1F2B37;
            --courseHeaderGradient1: rgba(0, 0, 0, 0.8);
            --courseHeaderGradient2: rgba(31, 43, 55, 0.8);
        }

        .course-teacher-profile {
            width: 40%;
        }

        .course-teacher-profile img {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            overflow: hidden;
            object-fit: cover;
        }

        .course-detail-header {
            color: white;
            width: 100%;
            background-image: linear-gradient(var(--courseHeaderGradient1), var(--courseHeaderGradient2)), url('/assets/img/dummy_course.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .content-link.active {
            background-color: rgb(115, 128, 236, 0.8);
            border: 1px solid var(--color-primary-variant);
            color: white;
        }

        .content-link {
            background-color: rgb(125, 141, 161, 0.7);
            border: 1px solid rgb(125, 141, 161, 0.7);
            color: white;
            border-radius: 10rem;
            transition: 0.3s;
        }

        .content-link:not(.active):hover {
            background-color: var(--color-info-dark);
            border: 1px solid var(--color-info-dark);
            color: white;
            transition: 0.3s;
        }

        .course-detail-body {
            min-height: 40rem;
            height: auto;
        }

        .course-detail-body .nav-link {
            background-color: transparent;
            transition: 0.3s;
        }

        .course-detail-body .nav-link.active {
            color: var(--color-primary);
            border-top: 1px solid var(--color-primary);
        }

        .material-link {
            background-color: var(--color-light);
            border: 1px solid var(--color-info-light);
            border-radius: 0.5rem;
            transition: 0.3s;
        }

        .material-link:hover:not(.add-material) {
            color: var(--color-primary);
            background-color: var(--color-background);
            border-color: var(--color-primary);
            transition: 0.3s;
        }

        .link-icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 3rem;
            height: 3rem;
            /* border: 2px solid rgb(128, 128, 128, 0.5); */
            border-radius: 0.5rem;
            background-color: var(--color-info-light);
            margin: auto;
        }

        .forum-container{
            max-height: 30rem;
            overflow-y: auto;
        }

        .forum-container .card{
            box-shadow: 5px var(--color-background) !important;
        }

        .forum-container .card-header{
            position: sticky;
            background-color: white;
        }

        .student-attendance{
            background-color: var(--color-light);
        }

        .canvas-wrapper {
            max-height: 40rem;
            border-radius: 3rem;
            overflow-x: hidden;
            overflow-y: scroll;
        }

        .canvas-wrapper::-webkit-scrollbar {
            display: none;
        }

        .canvas-wrapper {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        canvas {
            /* background-color: black;
            position: absolute;
            top: 0;
            left: 0; */
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('select').select2({
                theme: 'bootstrap4',
            });

            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif

            // edit / delete session material
            $('.material-action-btn').on('click', function(e) {
                event.stopPropagation();
                event.preventDefault();
                console.log(this);
            })

            var targetNode = document.querySelector('body');
            var config = { attributes: true, attributeFilter: ['class'] };
            var callback = function(mutationsList, observer) {
                for(var mutation of mutationsList) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        if (targetNode.classList.contains('sidebar-collapse')) {
                            setTimeout(resetCanvas, 1000);
                        } else {
                            setTimeout(resetCanvas, 1000);
                        }
                    }
                }
            };
            var observer = new MutationObserver(callback);
            observer.observe(targetNode, config);

            resetCanvas()
        })
    </script>

    {{-- canvas scripts --}}
    <script>
        let canvasListeners = {};

        $(window).resize(function() {
            resetCanvas();
        });

        function resetCanvas() {
            makeCanvas();
        }

        function drawLevel(ctx, x, y, level) {
            ctx.fillStyle = '#7d8da1';
            ctx.beginPath();
            ctx.arc(x, y, 30, 0, Math.PI * 2, true);
            ctx.fill();
            ctx.fillStyle = '#FFFFFF';
            ctx.font = '18px Arial';
            ctx.fillText(level, x - ctx.measureText(level).width / 2, y + 6);
        }

        function circleClickEvent(event, canvas, ctx, circleCoords) {
            const rect = canvas.getBoundingClientRect();
            const mouseX = event.clientX - rect.left;
            const mouseY = event.clientY - rect.top;
            circleCoords.forEach(coord => {
                const distance = Math.sqrt((mouseX - coord.x) ** 2 + (mouseY - coord.y) ** 2);
                if (distance <= 30) {
                    console.log('Level:', coord.level);
                }
            });
        }

        function circleHighlightInEvent(event, canvas, ctx, circleCoords) {
            const rect = canvas.getBoundingClientRect();
            const mouseX = event.clientX - rect.left;
            const mouseY = event.clientY - rect.top;
            circleCoords.forEach(coord => {
                const distance = Math.sqrt((mouseX - coord.x) ** 2 + (mouseY - coord.y) ** 2);
                if (distance <= 30) {
                    console.log('in');
                    ctx.beginPath();
                    ctx.arc(coord.x, coord.y, 30, 0, Math.PI * 2);
                    ctx.fillStyle = 'yellow';
                    ctx.fill();
                }
            });
        }

        function circleHighlightOutEvent(event, canvas, ctx, circleCoords) {
            const rect = canvas.getBoundingClientRect();
            const mouseX = event.clientX - rect.left;
            const mouseY = event.clientY - rect.top;
            circleCoords.forEach(coord => {
                const distance = Math.sqrt((mouseX - coord.x) ** 2 + (mouseY - coord.y) ** 2);
                if (distance <= 30) {
                    console.log('out');
                    ctx.beginPath();
                    ctx.arc(coord.x, coord.y, 30, 0, Math.PI * 2);
                    ctx.fillStyle = '#7d8da1';
                    ctx.fill();
                }
            });
        }

        function makeCanvas() {
            const backgroundImage = new Image();
            backgroundImage.src = "{{ url('/assets/img/canvas_example2.jpg') }}";
            backgroundImage.onload = function() {
                const canvas = document.getElementById('session-roadmap');
                const ctx = canvas.getContext('2d');
                const parentWidth = canvas.parentElement.clientWidth;
                const parentHeight = canvas.parentElement.clientHeight;
                const width = 800;
                const height = 800;
                canvas.width = parentWidth;
                canvas.height = height;
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                //background style
                canvas.style.backgroundImage = `url('${backgroundImage.src}')`;
                canvas.style.backgroundSize = 'cover';
                canvas.style.backgroundPosition = 'center';

                //line draw options
                const midX = canvas.width / 2;
                let scaleX = 50;
                let scaleY = 150;
                let currY = 150;
                let ctrlY1 = 50;
                let ctrlY2 = 100;
                let direction = false;
                let level = 1;
                let circleCoords = [];
                ctx.setLineDash([50, 20]);
                ctx.strokeStyle = '#FFF';
                ctx.lineWidth = 12;

                // draw line and circle
                ctx.beginPath();
                ctx.moveTo(midX, 0);
                ctx.lineTo(midX, 25);
                ctx.bezierCurveTo(midX, ctrlY1, midX - scaleX, ctrlY2, midX - scaleX, currY);
                circleCoords.push({ x: midX - scaleX, y: currY, level: level });
                while (currY < height) {
                    currY += scaleY;
                    ctrlY1 += scaleY;
                    ctrlY2 += scaleY;
                    direction = !direction;
                    level++;
                    if (direction) {
                        ctx.bezierCurveTo(midX - scaleX, ctrlY1, midX + scaleX, ctrlY2, midX + scaleX, currY);
                        circleCoords.push({ x: midX + scaleX, y: currY, level: level });
                    } else {
                        ctx.bezierCurveTo(midX + scaleX, ctrlY1, midX - scaleX, ctrlY2, midX - scaleX, currY);
                        circleCoords.push({ x: midX - scaleX, y: currY, level: level });
                    }
                }
                ctx.stroke();
                circleCoords.forEach(coord => {
                    drawLevel(ctx, coord.x, coord.y, coord.level);
                });

                //add events
                canvas.removeEventListener('click', canvasListeners.circleClickEvent);
                // canvas.removeEventListener('mouseenter', canvasListeners.circleHighlightInEvent);
                // canvas.removeEventListener('mouseout', canvasListeners.circleHighlightOutEvent);
                canvasListeners.circleClickEvent = function(event) {
                    circleClickEvent(event, canvas, ctx, circleCoords);
                }
                // canvasListeners.circleHighlightInEvent = function(event) {
                //     circleHighlightInEvent(event, canvas, ctx, circleCoords);
                // }
                // canvasListeners.circleHighlightOutEvent = function(event) {
                //     circleHighlightOutEvent(event, canvas, ctx, circleCoords);
                // }
                canvas.addEventListener('click', canvasListeners.circleClickEvent);
                // canvas.addEventListener('mouseenter', canvasListeners.circleHighlightInEvent);
                // canvas.addEventListener('mouseout', canvasListeners.circleHighlightOutEvent);
            }
        }
    </script>
@endsection
