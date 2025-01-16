@extends('layouts.app')
@section('stylesheets')
    <link rel="stylesheet" href="/assets/client/css/plugins/nouislider/nouislider.css">
    <style>
        .active-color {
            border: 2px solid #000000 !important;
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('/assets/client/images/page-header-bg.jpg')">
            <div class="container">
                @if (!empty($getSubcategory->name))
                    <h1 class="page-title text-uppercase">{{ $getSubcategory->name }}</h1>
                @elseif(!empty($getCategory->name))
                    <h1 class="page-title text-uppercase">{{ $getCategory->name }}</h1>
                @elseif(!empty(Request::get('q')))
                    <h1 class="page-title text-capitalize">Search for {{ Request::get('q') }}</h1>
                @endif

            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            @if (empty(Request::get('q')))
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">Shop</li>
                        @if (!empty($getSubcategory->name))
                            <li class="breadcrumb-item " aria-current="page">
                                <a href="{{ url('/' . $getCategory->slug) }}">{{ $getCategory->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a
                                    href="{{ url('/' . $getCategory->slug . '/' . $getSubcategory->slug) }}">{{ $getSubcategory->name }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ url('/' . $getCategory->slug) }}">{{ $getCategory->name }}</a>
                            </li>
                        @endif
                    </ol>
                </div><!-- End .container -->
            @endif

        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class=" {{ empty(Request::get('q')) ? 'col-lg-9' : 'col-lg-12' }}">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>9 of 56</span> Products
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control changeSortby">
                                            <option value="" selected="selected">Sort by</option>
                                            <option value="popularity">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div><!-- End .toolbox-sort -->
                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->
                        <div id="getProductAjax">
                            @include('product._listProduct')
                        </div>
                        {!! $products->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                    </div><!-- End .col-lg-9 -->
                    @if (empty(Request::get('q')))
                        <aside class="col-lg-3 order-lg-first">
                            <div class="sidebar sidebar-shop">
                                <div class="widget widget-clean">
                                    <label>Filters:</label>
                                    <a href="#" class="sidebar-filter-clear">Clean All</a>
                                </div><!-- End .widget widget-clean -->

                                <form id="filterForm">
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" id="categoryFilter" name="categoryFilter">
                                    <input type="hidden" class="form-control" id="colorFilter" name="colorFilter">
                                    <input type="hidden" class="form-control" id="brandFilter" name="brandFilter">
                                    <input type="hidden" class="form-control" id="startPriceFilter"
                                        name="startPriceFilter">
                                    <input type="hidden" class="form-control" id="endPriceFilter" name="endPriceFilter">
                                    <input type="text" class="form-control" id="sortByFilter" name="sortbyFilter"
                                        placeholder="sortBy">
                                </form>
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                            aria-controls="widget-1">
                                            Category
                                        </a>
                                    </h3><!-- End .widget-title -->
                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">
                                                @foreach ($subcategoriesFilter as $subcategoryFilter)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="custom-control-input changeCategory"
                                                                id="subcategory-{{ $subcategoryFilter->id }}"
                                                                name="subcategory-{{ $subcategoryFilter->id }}"
                                                                value="{{ $subcategoryFilter->id }}">
                                                            <label class="custom-control-label"
                                                                for="subcategory-{{ $subcategoryFilter->id }}">
                                                                {{ $subcategoryFilter->name }}
                                                            </label>
                                                        </div><!-- End .custom-checkbox -->
                                                        <span
                                                            class="item-count">{{ $subcategoryFilter->totalProduct }}</span>
                                                    </div><!-- End .filter-item -->
                                                @endforeach
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                            aria-controls="widget-3">
                                            Colour
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-3">
                                        <div class="widget-body">
                                            <div class="filter-colors">
                                                @foreach ($colorsFilter as $colorFilter)
                                                    <a href="javascript:;" id="{{ $colorFilter->id }}" data-val="0"
                                                        style="background: {{ $colorFilter->code }};"
                                                        class="changeColor"><span
                                                            class="sr-only ">{{ $colorFilter->name }}</span></a>
                                                @endforeach
                                            </div><!-- End .filter-colors -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                            aria-controls="widget-4">
                                            Brand
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-4">
                                        <div class="widget-body">
                                            <div class="filter-items">
                                                @foreach ($brandsFilter as $brandFilter)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="custom-control-input changeBrand"
                                                                id="brand-{{ $brandFilter->id }}"
                                                                name="brand-{{ $brandFilter->id }}"
                                                                value="{{ $brandFilter->id }}">
                                                            <label class="custom-control-label"
                                                                for="brand-{{ $brandFilter->id }}">{{ $brandFilter->name }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                            aria-controls="widget-5">
                                            Price
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-5">
                                        <div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
                                                    Price Range:
                                                    <span id="filter-price-range">$0 - $750</span>
                                                </div><!-- End .filter-price-text -->

                                                <div id="price-slider">

                                                </div><!-- End #price-slider -->
                                            </div><!-- End .filter-price -->
                                        </div><!-- End .widget-body -->
                                    </div>
                                </div><!-- End .widget -->
                            </div><!-- End .sidebar sidebar-shop -->
                        </aside><!-- End .col-lg-3 -->
                    @endif
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>
@endsection
@section('scripts')
    <script src="/assets/client/js/nouislider.min.js"></script>
    <script src="/assets/client/js/wNumb.js"></script>
    <script type="text/javascript">
        $('.changeCategory').change(function() {
            var ids = ''
            $('.changeCategory').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ', '
                }
            })
            $('#categoryFilter').val(ids)
            filterForm()
        })
        $('.changeBrand').change(function() {
            var ids = ''
            $('.changeBrand').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ', '
                }
            })
            $('#brandFilter').val(ids)
            filterForm()
        })
        $('.changeColor').click(function() {
            var id = $(this).attr('id');
            var status = $(this).attr('data-val');
            var color_ids = '';
            if (status == 0) {
                $(this).attr('data-val', 1)
                $(this).addClass('active-color')
            } else {
                $(this).attr('data-val', 0)
                $(this).removeClass('active-color')
            }
            $('.changeColor').each(function() {
                var status = $(this).attr('data-val');
                if (status == 1) {
                    var id = $(this).attr('id');
                    color_ids += id + ', '
                }
            })
            $('#colorFilter').val(color_ids)
            filterForm()
        })
        $("#sortby").change(function() {
            var id = $(this).val();
            $('#sortByFilter').val(id)
            filterForm()
        });
        var xhr;

        function filterForm() {
            if (xhr && xhr.readyState != 4) xhr.abort();
            xhr = $.ajax({
                type: "POST",
                url: "{{ url('get-filtered-products') }}",
                data: $('#filterForm').serialize(),
                dataType: "json",
                success: function(data) {
                    $('#getProductAjax').html(data.success);
                },
                error: function(data) {}
            })
        }
        var i = 0;
        if (typeof noUiSlider === 'object') {
            var priceSlider = document.getElementById('price-slider');


            noUiSlider.create(priceSlider, {
                start: [0, 750],
                connect: true,
                step: 10,
                margin: 50,
                range: {
                    'min': 0,
                    'max': 1000
                },
                tooltips: true,
                format: wNumb({
                    decimals: 0,
                    prefix: '$'
                })
            });

            // Update Price Range
            priceSlider.noUiSlider.on('update', function(values, handle) {
                var startPrice = values[0];
                var endPrice = values[1];

                $('#filter-price-range').text(values.join(' - '));
                $('#startPriceFilter').val(startPrice);
                $('#endPriceFilter').val(endPrice);
                if (i == 0 || i == 1) {
                    i++;
                } else {
                    filterForm();
                }
            });
        }
    </script>
@endsection
