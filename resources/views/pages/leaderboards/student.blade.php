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
                        <div class="widget-user-header first-place">
                            <h3 class="widget-user-username">{{ $second ? $second->user->name : 'No Data' }}</h3>
                            <h5 class="widget-user-desc">#2</h5>
                        </div>
                        <div class="widget-user-image box-profile">
                            <img class="profile-user-img img-circle elevation-2"
                                src="{{ asset('assets') }}/images/profile/{{ $second->user->image }}" alt="User Avatar">
                            <img class="user-badge my-0"
                                src="{{ asset('assets') }}/images/badges/{{ $second->profile->badge_name }}.png"
                                alt="User profile picture">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $second ? $second->profile->level : 'No Data' }}
                                        </h5>
                                        <span class="description-text">Level</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            {{ $second ? $second->profile->current_exp : 'No Data' }}</h5>
                                        <span class="description-text">Current Exp</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header second-place">
                            <h3 class="widget-user-username">{{ $first->user->name }}</h3>
                            <h5 class="widget-user-desc">#1</h5>
                        </div>
                        <div class="widget-user-image box-profile">
                            <img class="profile-user-img img-circle elevation-2"
                                src="{{ asset('assets') }}/images/profile/{{ $first->user->image }}" alt="User Avatar">
                            <img class="user-badge my-0"
                                src="{{ asset('assets') }}/images/badges/{{ $first->profile->badge_name }}.png"
                                alt="User profile picture">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $first->profile->level }}</h5>
                                        <span class="description-text">Level</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $first->profile->current_exp }}</h5>
                                        <span class="description-text">Current Exp</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header third-place">
                            <h3 class="widget-user-username">{{ $third ? $third->user->name : 'No Data' }}</h3>
                            <h5 class="widget-user-desc">#3</h5>
                        </div>
                        <div class="widget-user-image box-profile">
                            <img class="profile-user-img img-circle elevation-2"
                                src="{{ asset('assets') }}/images/profile/{{ $third->user->image }}" alt="User Avatar">
                            <img class="user-badge my-0"
                                src="{{ asset('assets') }}/images/badges/{{ $third->profile->badge_name }}.png"
                                alt="User profile picture">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $third ? $third->profile->level : 'No Data' }}
                                        </h5>
                                        <span class="description-text">Level</span>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            {{ $third ? $third->profile->current_exp : 'No Data' }}</h5>
                                        <span class="description-text">Current Exp</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <th>Level</th>
                            <th>Current Exp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 3; $i < $leaderboardCount; $i++)
                            @php
                                if ($isCurrentRole && $datas[$i]->user->id === $currentUserId) {
                                    $isTopTen = true;
                                }
                            @endphp
                            <tr
                                style="{{ $isCurrentRole && $datas[$i]->user->id === $currentUserId ? 'background-color: var(--color-primary-xlight);' : '' }}">
                                <td>#{{ $i }}</td>
                                <td>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('assets') }}/images/profile/{{ $datas[$i]->user->image }}"
                                            alt="user image">
                                        <span class="username text-truncate">
                                            {{ $datas[$i]->user->name }}
                                        </span>
                                        <span class="description text-truncate">
                                            {{ $datas[$i]->user->email }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $datas[$i]->profile->level }}</td>
                                <td>{{ $datas[$i]->profile->current_exp }}</td>
                            </tr>
                        @endfor
                        @if ($isCurrentRole && $isTopTen == false)
                            @php
                                $thisStudent = $datas->where('user_id', $currentUserId)->all();
                                $thisRank = array_keys($thisStudent)[0];
                                $thisStudent = $thisStudent[$thisRank];
                            @endphp
                            <tr>
                                <td>.....</td>
                                <td>.....</td>
                                <td>.....</td>
                                <td>.....</td>
                            </tr>
                            <tr style="background-color: var(--color-primary-xlight);">
                                <td>#{{ $thisRank }}</td>
                                <td>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('assets') }}/images/profile/{{ $thisStudent->user->image }}"
                                            alt="user image">
                                        <span class="username text-truncate">
                                            {{ $thisStudent->user->name }}
                                        </span>
                                        <span class="description text-truncate">
                                            {{ $thisStudent->user->email }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $thisStudent->profile->level }}</td>
                                <td>{{ $thisStudent->profile->current_exp }}</td>
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

        .user-badge {
            width: 60px !important;
            height: 60px !important;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 40px;
            right: 0;
            top: 60px;
            text-align: center;
            border: none !important;
        }

        tbody tr {
            background: white;
            box-shadow: var(--box-shadow) !important;
            vertical-align: middle !important;
        }

        tbody td {
            padding: 25px 12px !important;
            vertical-align: middle !important;
        }

        .widget-user-username {
            color: white;
        }

        .first-place,
        .second-place,
        .third-place {
            color: white;
        }

        .first-place {
            background-color: var(--color-primary);
        }

        .second-place {
            background-color: var(--color-warning);
        }

        .third-place {
            background-color: var(--color-danger);
        }
    </style>
@endsection

@section('js-script')

@endsection
