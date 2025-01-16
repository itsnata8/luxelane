@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Sub Category</li>
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
                                Sub Category List
                            </h3>
                            <div class=" text-right"><a href="{{ route('subcategories.create') }}"
                                    class="btn-sm btn-primary"><i class="fas fa-plus-square mr-1"></i> Add New
                                    Sub Category</a></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Slug</th>
                                        <th>Meta Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keywords</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $key => $subcategory)
                                        <tr>
                                            <td>{{ $subcategories->firstItem() + $key }}</td>
                                            <td>{{ $subcategory->category_id }}</td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td>{{ $subcategory->slug }}</td>
                                            <td>{{ $subcategory->meta_title }}</td>
                                            <td>{{ $subcategory->meta_description }}</td>
                                            <td>{{ $subcategory->meta_keywords }}</td>
                                            <td>{{ $subcategory->created_by }}</td>
                                            <td>{{ $subcategory->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($subcategory->created_at)) }}</td>
                                            <td><a class="btn btn-link text-primary admin-edit-btn"
                                                    href="{{ route('subcategories.edit', $subcategory->id) }}">Edit</a>
                                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
                                                    method="post" class="d-inline"
                                                    onsubmit="return confirm('Are you sure want to delete this sub category?');">
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
                                    {{ $subcategories->links() }}
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
