@extends('admin.layouts.page-layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('subcategories.index') }}" class="d-flex align-items-center"> <i
                            class="fas fa-long-arrow-alt-left mr-2 text-xs"></i>
                        Back to Sub Category List
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Sub Category</a></li>
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
                            <h3 class="card-title">Add New Sub Category</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form method="post" action="{{ route('subcategories.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Category Name <span class="text-danger">*</span></label>
                                    <select class="custom-select {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                        id="category_id" name="category_id">
                                        <option value="" disabled selected>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="name">Sub Category Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        id="name" placeholder="Enter sub category name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" name="slug"
                                        id="slug" placeholder="Slug Ex. URL" value="{{ old('slug') }}">
                                </div>
                                @error('slug')
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
                                <hr>
                                <div class="form-group">
                                    <label for="meta_title">Meta title <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                        name="meta_title" id="meta_title" placeholder="Meta title"
                                        value="{{ old('meta_title') }}">
                                </div>
                                @error('meta_title')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Meta description" style="height: 87px;"
                                        class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description"
                                        id="meta_description">{{ old('meta_description') }}</textarea>
                                </div>
                                @error('meta_description')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}"
                                        name="meta_keywords" id="meta_keywords" placeholder="Meta keywords"
                                        value="{{ old('meta_keywords') }}">
                                </div>
                                @error('meta_keywords')
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
