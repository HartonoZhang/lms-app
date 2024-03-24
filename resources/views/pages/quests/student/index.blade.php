@extends('layouts.template')

@section('title', 'Daily Quest')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Daily Quest</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        Daily quest
    </div>
@endsection



@section('css-link')
    <style>
      
    </style>
@endsection

@section('js-script')

    <script type="text/javascript">
        $(function() {
           
        })
    </script>
@endsection
