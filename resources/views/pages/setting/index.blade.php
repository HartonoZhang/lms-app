@extends('pages.layouts.template')

@section('title', 'Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                            <input type="file" id="inputName" class="form-control" value="AdminLTE">
                            <small id="emailHelp" class="form-text text-muted">Recommended image size is 150px x 150px</small>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Favicon *</label>
                            <input type="file" id="inputName" class="form-control" value="AdminLTE">
                            <small id="emailHelp" class="form-text text-muted">Recommended image size is 16px x 16px or 32px x 32px</small>
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
                        <h3 class="card-title">General</h3>
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

    <div class="modal fade" id="modal-update-photo">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/updatePhoto" method="POST" enctype="multipart/form-data" data-remote="true">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">Update Profile Photo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control" id="image" name="image">
                            @error('file')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer float-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
