@extends('layouts.template')

@section('title', 'Teacher Leaderboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Leaderboard</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="text-center mb-4">
            <h4>Top Teacher</h4>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header first-place">
                        <h3 class="widget-user-username">Alexander Pierce</h3>
                        <h5 class="widget-user-desc"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2"
                            src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">2</h5>
                                    <span class="description-text">Level</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">Point</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header second-place">
                        <h3 class="widget-user-username">Alexander Pierce</h3>
                        <h5 class="widget-user-desc"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2"
                            src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">2</h5>
                                    <span class="description-text">Level</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">Point</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header third-place">
                        <h3 class="widget-user-username">Alexander Pierce</h3>
                        <h5 class="widget-user-desc"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('assets') }}/images/profile/test.jpeg"
                            alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">2</h5>
                                    <span class="description-text">Level</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">Point</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th colspan="2">Teacher</th>
                    <th>Score</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">1st test</td>
                    <td>123</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="2">2st test</td>
                    <td>123</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="2">1st test</td>
                    <td>123</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="2">2st test</td>
                    <td>123</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="2">1st test</td>
                    <td>123</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="2">2st test</td>
                    <td>123</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('css-link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .table {
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 0px 10px;
        }

        tbody tr {
            background: white;
            box-shadow: var(--box-shadow) !important;
        }

        tbody td {
            padding: 25px 12px !important;
        }

        .widget-user-username {
            color: white;
        }

        .first-place {
            background-color: var(--color-primary);
        }

        .second-place {
            background-color: var(--color-primary-light);
        }

        .third-place {
            background-color: var(--color-primary-xlight);
        }
    </style>
@endsection

@section('js-script')

@endsection
