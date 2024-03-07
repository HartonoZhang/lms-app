@extends('layouts.template')

@section('title', 'Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Website Basic Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Website Name *</label>
                            <input type="text" id="inputName" class="form-control" value="AdminLTE">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Logo *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Recommended image size is 150px x
                                150px</small>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Favicon *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Recommended image size is 16px x 16px or 32px
                                x 32px</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Address</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Address Line *</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="form-row my-2">
                                <div class="col-sm">
                                    <label for="inputDescription">City</label>
                                    <input type="text" class="form-control" placeholder="City">
                                </div>
                                <div class="col-sm">
                                    <label for="inputDescription">State/Province</label>
                                    <input type="text" class="form-control" placeholder="State/Province">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row my-2">
                                <div class="col-sm">
                                    <label for="inputDescription">Zip/Postal code</label>
                                    <input type="text" class="form-control" placeholder="Zip/Postal code">
                                </div>
                                <div class="col-sm">
                                    <label for="inputDescription">Country</label>
                                    <input type="text" class="form-control" placeholder="Country">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
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
