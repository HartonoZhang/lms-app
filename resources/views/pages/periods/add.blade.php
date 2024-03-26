@extends('layouts.template')

@section('title', 'Add Periods')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Add Period</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Period Information
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action={{route('period-add')}} method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="text" id="periodName" class="form-control form-control-mb"
                                    placeholder="Period Name" name="period_name" value="{{old('period_name')}}"/>
                                <label for="firstName">Period Name*</label>
                            </div>
                            @error('period_name')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="date" id="startDate" class="form-control form-control-mb"
                                    placeholder="Start Date" name="start_date" value="{{old('start_date')}}" onchange=check() />
                                <label for="startDate">Start Date*</label>
                            </div>
                            @error('start_date')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="form-label-group in-border mb-1">
                                <input type="date" id="endDate" class="form-control form-control-mb"
                                    placeholder="End Date" name="end_date" {{old('end_date') ? '' : 'disabled'}} value="{{old('end_date')}}"/>
                                <label for="endDate">End Date*</label>
                            </div>
                            @error('end_date')
                            <p class="text-danger mb-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a type="button" href="{{route('period-list')}}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <script type="text/javascript">
                        var startDate = document.getElementById('startDate');
                        var endDate = document.getElementById('endDate');
                        function check(){
                            if(startDate.value){
                                endDate.removeAttribute('disabled')
                                if(startDate.value > endDate.value)
                                    endDate.value = ""
                                endDate.setAttribute('min',startDate.value)
                            }else{
                                endDate.setAttribute('disabled','')
                                endDate.value = ""
                            }
                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">

    <style>
        label {
            font-weight: 400 !important;
        }
    </style>
@endsection

@section('js-script')
    <!-- Toastr -->
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
            @if (Session::has('status'))
                @if (Session::get('status') === 'success')
                    toastr.success('{{ Session::get('message') }}')
                @elseif (Session::get('status') === 'fail')
                    toastr.error('{{ Session::get('message') }}')
                @endif
            @endif
        })
    </script>
@endsection
