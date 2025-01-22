@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('discount-codes.index') }}" class="d-flex align-items-center"> <i
                            class="fas fa-long-arrow-alt-left mr-2 text-xs"></i>
                        Back to Discount Coupon List
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('discount-codes.index') }}">Discount Coupon</a>
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
                            <h3 class="card-title">Edit Discount Coupon</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form method="post" action="{{ route('discount-codes.update', $coupon->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Discount Coupon Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        id="name" placeholder="Enter discount coupon name" value="{{ $coupon->name }}">
                                </div>
                                @error('name')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}"
                                        name="type">
                                        <option value="" disabled>Select Type</option>
                                        <option value="amount" {{ $coupon->type == 'amount' ? 'selected' : '' }}>Amount
                                        </option>
                                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent
                                        </option>
                                    </select>
                                </div>
                                @error('type')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="percent_amount">Percent / Amount <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('percent_amount') ? 'is-invalid' : '' }}"
                                        name="percent_amount" id="percent_amount" placeholder="Percent / Amount"
                                        value="{{ $coupon->percent_amount }}">
                                </div>
                                @error('percent_amount')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="expire_date">Expire Date <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control datetimepicker-input {{ $errors->has('percent_amount') ? 'is-invalid' : '' }}"
                                            value="{{ $coupon->expire_date }}" data-target="#reservationdate"
                                            name="expire_date" placeholder="Expire Date">
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                @error('expire_date')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status"
                                            {{ $coupon->status ? 'checked' : '' }}>
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
