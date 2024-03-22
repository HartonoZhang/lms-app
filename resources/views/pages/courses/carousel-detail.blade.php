@extends('layouts.template')

@section('title', 'Example Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Example Courses</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="col-md-11 mx-auto">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#description"
                                            data-toggle="tab">Description</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#security" data-toggle="tab">Security</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="description">
                                        <h1>adaasd</h1>
                                        <h1>adaasd</h1>
                                        <h1>adaasd</h1>
                                        <h1>adaasd</h1>
                                        <h1>adaasd</h1>
                                    </div>
                                    <div class="tab-pane" id="settings">
                                        <h1>adaasd</h1>
                                        <h1>adaasd</h1>
                                        <h1>adaasd</h1>
                                    </div>
                                    <div class="tab-pane" id="security">
                                      <h1>adaasd</h1>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                  <div class="col-md-11 mx-auto">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#description-1"
                                        data-toggle="tab">Description</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings-1" data-toggle="tab">Settings</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#security-1" data-toggle="tab">Security</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="description-1">
                                    <h1>adaasd 1</h1>
                                    <h1>adaasd1</h1>
                                    <h1>adaasd1</h1>
                                    <h1>adaasd1</h1>
                                    <h1>adaasd1</h1>
                                </div>
                                <div class="tab-pane" id="settings-1">
                                    <h1>adaasd1</h1>
                                    <h1>adaasd1</h1>
                                    <h1>adaasd1</h1>
                                </div>
                                <div class="tab-pane" id="security-1">
                                  <h1>adaasd1</h1>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="carousel-item">
                  <div class="col-md-11 mx-auto">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#description-2"
                                        data-toggle="tab">Description</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings-2" data-toggle="tab">Settings</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#security-2" data-toggle="tab">Security</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="description-2">
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                </div>
                                <div class="tab-pane" id="settings-2">
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                    <h1>adaasd2</h1>
                                </div>
                                <div class="tab-pane" id="security-2">
                                  <h1>adaasd 2</h1>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active">1</li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1">2</li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2">3</li>
            </ol>
            <button class="carousel-control-prev d-lg-flex d-none" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next d-lg-flex d-none" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
@endsection

@section('css-link')

    <style>
        .carousel-inner {
            padding-bottom: 40px;
        }

        .carousel-indicators {
            position: relative;
            bottom: 40px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            height: 40px;
            width: 40px;
            outline: var(--color-primary);
            border-radius: 50%;
            top: 45%;
            border: 1px solid var(--color-primary);
            background-color: var(--color-primary);
            transform: translate(0, -50%);
        }

        .carousel .carousel-indicators li,
        .carousel .carousel-indicators li.active {
            background-color: var(--color-primary);
        }

        .carousel-indicators li {
            border-radius: 50%;
            width: 27px;
            height: 27px;
            text-indent: -1px;
            color: white;
            text-align: center;
        }
    </style>
@endsection

@section('js-script')

    <script type="text/javascript">
        $(function() {

        })
    </script>
@endsection
