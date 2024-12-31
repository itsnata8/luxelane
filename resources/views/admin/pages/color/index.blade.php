@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Color</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Color</li>
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
                                Color List
                            </h3>
                            <div class=" text-right"><a href="{{ route('colors.create') }}" class="btn-sm btn-primary"><i
                                        class="fas fa-plus-square mr-1"></i> Add New
                                    Color</a></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $color)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $color->name }}</td>
                                            <td>{{ $color->code }}</td>
                                            <td>{{ $color->created_by }}</td>
                                            <td>{{ $color->status ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($color->created_at)) }}</td>
                                            <td><a class="btn btn-link text-primary admin-edit-btn"
                                                    href="{{ route('colors.edit', $color->id) }}">Edit</a>
                                                <form action="{{ route('colors.destroy', $color->id) }}" method="post"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure want to delete this color?');">
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
                                    {{ $colors->links() }}
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
