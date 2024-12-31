@extends('admin.layouts.page-layout')

@section('stylesheets')
    <link rel="stylesheet" href="/assets/admin/plugins/summernote/summernote-bs4.min.css">
@endsection

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
                    @include('admin.inc._toast')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('products.update', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                name="title" id="title" placeholder="Enter title"
                                                value="{{ $product->title }}">
                                        </div>
                                        @error('title')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="sku">SKU <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}"
                                                name="sku" id="sku" placeholder="SKU" value="{{ $product->sku }}">
                                        </div>
                                        @error('sku')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="category">Category <span class="text-danger">*</span></label>
                                            <select
                                                class="custom-select {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                                id="ChangeCategory" name="category">
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id === $product->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="subcategory">Sub Category <span class="text-danger">*</span></label>
                                            <select
                                                class="custom-select {{ $errors->has('subcategory') ? 'is-invalid' : '' }}"
                                                id="getSubcategories_select" name="subcategory">
                                                @if (empty($subcategories))
                                                    {
                                                    <option value="" disabled selected>Select Subcategory</option>
                                                    }
                                                @endif
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ $subcategory->id === $product->sub_category_id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('subcategory')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand">Brand <span class="text-danger">*</span></label>
                                            <select class="custom-select {{ $errors->has('brand') ? 'is-invalid' : '' }}"
                                                id="brand" name="brand">
                                                <option value="" disabled selected>Select category</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand->id === $product->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('brand')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color">Color <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                @foreach ($colors as $color)
                                                    @php
                                                        $checked = '';
                                                    @endphp
                                                    @foreach ($productColors as $productColor)
                                                        @if ($productColor->id == $color->id)
                                                            @php
                                                                $checked = 'checked';
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <div>
                                                        <input class="form-check-input" type="checkbox"
                                                            id="color_{{ $color->id }}" value="{{ $color->id }}"
                                                            name="color_id[{{ $color->id }}]" {{ $checked }}>
                                                        <label class="form-check-label text-bold"
                                                            for="color_{{ $color->id }}">{{ $color->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @error('color')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="price">Price ($) <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                                name="price" id="price" placeholder="Price"
                                                value="{{ $product->price }}">
                                        </div>
                                        @error('price')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="old_price">Old Price ($) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('old_price') ? 'is-invalid' : '' }}"
                                                name="old_price" id="old_price" placeholder="Old Price"
                                                value="{{ $product->old_price }}">
                                        </div>
                                        @error('old_price')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="card-body p-2">
                                        <label for="old_price">Size <span class="text-danger">*</span></label>
                                        <hr>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price ($)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="AppendSize">
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="size[100][name]"
                                                            placeholder="Size" required
                                                            value="{{ $productSizes[0]->name ?? '' }}">
                                                    </td>
                                                    <td><input type="text" class="form-control"
                                                            name="size[100][price]" placeholder="Price" required
                                                            value="{{ $productSizes[0]->price ?? '' }}">
                                                    </td>
                                                    <td><button class="btn btn-link text-primary"
                                                            id="AddSizeBtn">Add</button>
                                                    </td>
                                                </tr>
                                                @for ($i = 101; $i < 100 + count($productSizes); $i++)
                                                    <tr id="DeleteSize{{ $i }}">
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                name="size[{{ $i }}][name]" placeholder="Size"
                                                                value="{{ $productSizes[$i - 100]->name }}" required>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                name="size[{{ $i }}][price]"
                                                                placeholder="Price"
                                                                value="{{ $productSizes[$i - 100]->price }}" required>
                                                        </td>
                                                        <td><button class="btn btn-link text-danger DeleteSize"
                                                                id="{{ $i }}">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <label for="image">Image</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image[]"
                                            multiple>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                @if ($productImages != null)
                                    <div class="row" id="sortable">
                                        @foreach ($productImages as $productImage)
                                            <div class="col-md-2 mr-2 text-center sortable_image"
                                                id="{{ $productImage->id }}">
                                                <img src="/upload/product/{{ $productImage->image_name }}"
                                                    class="img-thumbnail" alt="product image"
                                                    style="height: 200px !important; width: 200px !important;object-fit: cover !important;">
                                                <a href="{{ route('products.destroyImage', $productImage->id) }}"
                                                    class="btn btn-link text-danger"
                                                    onclick="return confirm('Are you sure want to delete this image?');">Delete</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-danger">No images</p>
                                @endif
                                <hr>
                                <div class="form-group">
                                    <label for="short_description">Short Description <span
                                            class="text-danger">*</span></label>
                                    <textarea id="summernote_short_description" class="form-control" rows="3" placeholder="Short Description"
                                        style="height: 87px;" class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                                        name="short_description" id="short_description">{{ $product->short_description }}</textarea>
                                </div>
                                @error('short_description')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea id="summernote_description" class="form-control" rows="3" style="height: 87px;"
                                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ $product->description }}</textarea>
                                </div>
                                @error('description')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="additional_information">Additional Information <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="summernote_additional_information" rows="3" style="height: 87px;"
                                        class="form-control {{ $errors->has('additional_information') ? 'is-invalid' : '' }}"
                                        name="additional_information">{{ $product->additional_information }}</textarea>
                                </div>
                                @error('additional_information')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="shipping_returns">Shipping Returns <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="summernote_shipping_returns" rows="3" style="height: 87px;"
                                        class="form-control {{ $errors->has('shipping_returns') ? 'is-invalid' : '' }}" name="shipping_returns">{{ $product->shipping_returns }}</textarea>
                                </div>
                                @error('shipping_returns')
                                    <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status"
                                            id="status">
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
    <script src="/assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/assets/admin/sortable/jquery-ui.js"></script>
    <script>
        $(function() {
            // Summernote
            $('#summernote_short_description').summernote(), $('#summernote_description').summernote(), $(
                    '#summernote_additional_information').summernote(), $('#summernote_shipping_returns')
                .summernote()
        })
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $(document).ready(function(event, ui) {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var image_id = new Array();
                    $('.sortable_image').each(function() {
                        image_id.push($(this).attr('id'));
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ url('admin/product_image_sortable') }}',
                        data: {
                            'image_id': image_id,
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {

                        },
                        error: function(data) {

                        }
                    })
                }
            });
        })
    </script>
    <script>
        var i = 100 + $('#AppendSize tr').length;
        $('body').delegate('#AddSizeBtn', 'click', function(e) {
            e.preventDefault();
            var html = `
            <tr id="DeleteSize${i}">
                <td>
                    <input type="text" class="form-control" name="size[${i}][name]" placeholder="Size" required>
                </td>
                <td><input type="text" class="form-control" name="size[${i}][price]" placeholder="Price" required></td>
                <td><button class="btn btn-link text-danger DeleteSize" id="${i}">Delete</button>
                </td>
            </tr>
            `;
            i++;
            $('#AppendSize').append(html);
        })

        $('body').delegate('.DeleteSize', 'click', function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $('#DeleteSize' + id).remove();
        })

        $('body').delegate('#ChangeCategory', 'change', function(e) {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/get-subcategories') }}",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    $('#getSubcategories_select').html(response.html);
                },
                error: function(response) {}
            })
        })
    </script>
@endsection
