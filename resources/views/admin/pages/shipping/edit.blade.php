@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('shipping.index') }}" class="d-flex align-items-center"> <i
                            class="fas fa-long-arrow-alt-left mr-2 text-xs"></i>
                        Back to Shipping Charges List
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('discount-codes.index') }}">Shipping
                                Charges</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Edit Shipping Charge</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form method="post" action="{{ route('shipping.update', $shippingCharge->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Shipping Charge Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        id="name" placeholder="Enter shipping charge name"
                                        value="{{ $shippingCharge->name }}">
                                </div>
                                @error('name')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" name="price"
                                        id="price" placeholder="price" value="{{ $shippingCharge->price }}">
                                </div>
                                @error('price')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status"
                                            {{ $shippingCharge->status ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Active</label>
                                    </div>
                                </div>
                                <hr>
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
    <script>
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@endsection
