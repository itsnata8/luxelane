@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Charge</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shipping Charge List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            @include('admin.inc._toast')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Shipping Charge List
                            </h3>
                            <div class=" text-right"><a href="{{ route('shipping.create') }}" class="btn-sm btn-primary"><i
                                        class="fas fa-plus-square mr-1"></i> Add New
                                    Shipping Charge</a></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shippingCharges as $key => $item)
                                        <tr>
                                            <td>{{ $shippingCharges->firstItem() + $key }}</td>
                                            <td class="text-capitalize">{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td><a class="btn btn-link text-primary admin-edit-btn"
                                                    href="{{ route('shipping.edit', $item->id) }}">Edit</a>
                                                <form action="{{ route('shipping.destroy', $item->id) }}" method="post"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure want to delete this shipping charge?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger admin-delete-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer clearfix">
                                <div class="pagination pagination-sm m-0 float-right">
                                    {{ $shippingCharges->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
