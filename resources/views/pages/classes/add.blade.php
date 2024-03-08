@extends('layouts.template')

@section('title', 'Add Classes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Add Classes</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Class Information
                </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="/admin/add-student" method="POST" enctype="multipart/form-data"
                    data-remote="true">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="firstName" class="form-control form-control-mb"
                                    placeholder="First Name" />
                                <label for="firstName">Class Code*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="lastName" class="form-control form-control-mb"
                                    placeholder="Last Name" />
                                <label for="lastName">Class Name*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <input type="text" id="phoneNumber" class="form-control form-control-mb"
                                    placeholder="Phone Number" />
                                <label for="phoneNumber">Minimun Score*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="gender">
                                    <option disabled selected>Select a course</option>
                                    <option value=''>Laki laki
                                    </option>
                                    <option value=''>Perempuan
                                    </option>
                                </select>
                                <label for="inputGender">Course*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <select class="form-control form-control-mb select2" style="width: 100%;" name="gender">
                                    <option disabled selected>Select students</option>
                                    <option value=''>Laki laki
                                    </option>
                                    <option value=''>Perempuan
                                    </option>
                                </select>
                                <label for="inputGender">Students*</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-label-group in-border">
                                <select class="select2 form-control form-control-mb" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                  </select>
                                <label for="inputGender">Teachers*</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
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

        label {
            font-weight: 400 !important;
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
        })
    </script>
@endsection
