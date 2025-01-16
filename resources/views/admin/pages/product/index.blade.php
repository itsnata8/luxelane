@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                                Product List
                            </h3>
                            <div class=" text-right"><a href="{{ route('products.create') }}" class="btn-sm btn-primary"><i
                                        class="fas fa-plus-square mr-1"></i> Add New
                                    Product</a></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{ $products->firstItem() + $key }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->created_by }}</td>
                                            <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                                            <td><a class="btn btn-link text-primary admin-edit-btn"
                                                    href="{{ route('products.edit', $product->id) }}">Edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure want to delete this category?');">
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
                                    {{ $products->links() }}
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
