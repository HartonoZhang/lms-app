@extends('layouts.template')

@section('title', 'Student Leaderboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{ strtolower(Auth::user()->role->name) }}">Home</a></li>
    <li class="breadcrumb-item active">Leaderboard</li>
@endsection

@section('content')
    @if ($datas->all())
        <div class="container-fluid h-100">
            <div class="text-center mb-4">
                <h4>Top Student</h4>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header first-place">
                            <h3 class="widget-user-username">{{$second ? $second->user->name : "No Data"}}</h3>
                            <h5 class="widget-user-desc">#2</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$second ? $second->profile->level : "No Data"}}</h5>
                                        <span class="description-text">Level</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$second ? $second->profile->current_exp : "No Data"}}</h5>
                                        <span class="description-text">Current Exp</span>
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
                            <h3 class="widget-user-username">{{$first->user->name}}</h3>
                            <h5 class="widget-user-desc">#1</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$first->profile->level}}</h5>
                                        <span class="description-text">Level</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$first->profile->current_exp}}</h5>
                                        <span class="description-text">Current Exp</span>
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
                            <h3 class="widget-user-username">{{$third ? $third->user->name : "No Data"}}</h3>
                            <h5 class="widget-user-desc">#3</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$third ? $third->profile->level : "No Data"}}</h5>
                                        <span class="description-text">Level</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$third ? $third->profile->current_exp : "No Data"}}</h5>
                                        <span class="description-text">Current Exp</span>
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
            @php
                $isTopTen = false;
                $currentUserId = Auth::user()->id;
                $leaderboardCount = $datas->count() >= 11 ? 11 : $datas->count();
            @endphp
            @if ($leaderboardCount > 3)
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Current Exp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 3; $i < $leaderboardCount; $i++)
                        @php
                            if($isCurrentRole && $datas[$i]->user->id === $currentUserId) $isTopTen = true;
                        @endphp
                        <tr style="{{$isCurrentRole && $datas[$i]->user->id === $currentUserId ? "background-color: var(--color-primary-light);" : ""}}">
                            <td>#{{$i}}</td>
                            <td>{{$datas[$i]->user->name}}</td>
                            <td>{{$datas[$i]->user->email}}</td>
                            <td>{{$datas[$i]->profile->level}}</td>
                            <td>{{$datas[$i]->profile->current_exp}}</td>
                        </tr>
                        @endfor
                        @if ($isCurrentRole && $isTopTen == false)
                            @php
                                $thisStudent = $datas->where('user_id',$currentUserId)->all();
                                $thisRank = array_keys($thisStudent)[0];
                                $thisStudent = $thisStudent[$thisRank];
                            @endphp
                            <tr>
                                <td>.....</td>
                                <td>.....</td>
                                <td>.....</td>
                                <td>.....</td>
                                <td>.....</td>
                            </tr>
                            <tr style="background-color: var(--color-primary-light);">
                                <td>#{{$thisRank}}</td>
                                <td>{{$thisStudent->user->name}}</td>
                                <td>{{$thisStudent->user->email}}</td>
                                <td>{{$thisStudent->profile->level}}</td>
                                <td>{{$thisStudent->profile->current_exp}}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            @endif
        </div>
    @else
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    Error : Can't show student leaderboard
                </h3>
            </div>
            <div class="card-body">
                <p class="card-text">Can't show student leaderboard because there is no teacher data available !!</p>   
                
            </div>
        </div>
    @endif
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
