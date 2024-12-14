@extends('admin.layouts.page-layout')
@section('stylesheets')
    <link rel="stylesheet" href="/assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('colors.index') }}" class="d-flex align-items-center"> <i
                            class="fas fa-long-arrow-alt-left mr-2 text-xs"></i>
                        Back to Color List
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('colors.index') }}">Color</a></li>
                        <li class="breadcrumb-item active">New</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Color</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form method="post" action="{{ route('colors.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Color Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        id="name" placeholder="Enter color name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="code">Color Code <span class="text-danger">*</span></label>
                                    <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                                        <input type="text" class="form-control" id="codeColor" name="code"
                                            placeholder="Enter color code">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                @error('code')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status">
                                        <label class="custom-control-label" for="status">Active</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script src="/assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script>
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })
    </script>
@endsection
