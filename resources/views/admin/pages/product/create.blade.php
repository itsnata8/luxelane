@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('products.index') }}" class="d-flex align-items-center"> <i
                            class="fas fa-long-arrow-alt-left mr-2 text-xs"></i>
                        Back to Product List
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Product</a></li>
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
                            <h3 class="card-title">Add New Product</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form method="post" action="{{ route('products.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
                                        id="title" placeholder="Enter title" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
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
