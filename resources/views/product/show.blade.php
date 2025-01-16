@extends('layouts.app')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ url('/' . $product->category->slug) }}">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ url('/' . $product->category->slug) }}">{{ $product->subCategory->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>

                <nav class="product-pager ml-auto" aria-label="Product">
                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                        <i class="icon-angle-left"></i>
                        <span>Prev</span>
                    </a>

                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                        <span>Next</span>
                        <i class="icon-angle-right"></i>
                    </a>
                </nav><!-- End .pager-nav -->
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="/upload/product/{{ $product->images->first()->image_name }}"
                                        data-zoom-image="/upload/product/{{ $product->images->first()->image_name }}"
                                        alt="product image">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->
                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($product->images as $image)
                                        <a class="product-gallery-item" href="#"
                                            data-image="/upload/product/{{ $image->image_name }}"
                                            data-zoom-image="/upload/product/{{ $image->image_name }}">
                                            <img src="/upload/product/{{ $image->image_name }}" alt="product image">
                                        </a>
                                    @endforeach
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->title }}</h1>
                                <!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div><!-- End .rating-container -->

                                <div class="product-price">
                                    $<span id="totalPrice">{{ number_format($product->price, 2) }}</span>
                                </div><!-- End .product-price -->

                                <div class="product-content">
                                    {!! $product->short_description !!}
                                </div><!-- End .product-content -->

                                <div class="details-filter-row details-row-size">
                                    <label for="color">Color:</label>
                                    <div class="select-custom">
                                        <select name="color" id="color" class="form-control">
                                            <option value="" selected disabled>Select a color</option>
                                            @foreach ($product->colors as $productColor)
                                                <option value="{{ $productColor->id }}">{{ $productColor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .details-filter-row -->

                                <div class="details-filter-row details-row-size">
                                    <label for="size">Size:</label>
                                    <div class="select-custom">
                                        <select name="size" id="size" class="form-control getSizePrice">
                                            <option data-price="0" value="" selected="selected" disabled>Select a size
                                            </option>
                                            @foreach ($product->sizes as $productSize)
                                                <option value="{{ $productSize->id }}"
                                                    data-price="{{ $productSize->price }}" class="text-capitalize">
                                                    {{ $productSize->name }}
                                                    (${{ number_format($productSize->price, 2) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .details-filter-row -->

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" value="1"
                                            min="1" max="10" step="1" data-decimals="0" required=""
                                            style="display: none;">
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->

                                <div class="product-details-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                                    <div class="details-action-wrapper">
                                        <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to
                                                Wishlist</span></a>
                                        <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to
                                                Compare</span></a>
                                    </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="#">Women</a>,
                                        <a href="#">Shoes</a>,
                                        <a href="#">Sandals</a>,
                                        <a href="#">Yellow</a>
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->
            </div><!-- End .container -->

            <div class="product-details-tab product-details-extended">
                <div class="container">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                role="tab" aria-controls="product-info-tab" aria-selected="false">Additional
                                information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Shipping &amp; Returns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="product-review-link" data-toggle="tab"
                                href="#product-review-tab" role="tab" aria-controls="product-review-tab"
                                aria-selected="true">Reviews (2)</a>
                        </li>
                    </ul>
                </div><!-- End .container -->

                <div class="tab-content">
                    <div class="tab-pane fade" id="product-desc-tab" role="tabpanel"
                        aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <div class="container">
                                {!! $product->description !!}
                            </div>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                        aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <div class="container">
                                {!! $product->additional_information !!}
                            </div><!-- End .container -->
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                        aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <div class="container">
                                {!! $product->shipping_returns !!}
                            </div><!-- End .container -->
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade active show" id="product-review-tab" role="tabpanel"
                        aria-labelledby="product-review-link">
                        <div class="reviews">
                            <div class="container">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">6 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum
                                                    dolores assumenda asperiores facilis porro reprehenderit animi culpa
                                                    atque blanditiis commodi perspiciatis doloremque, possimus, explicabo,
                                                    autem fugit beatae quae voluptas!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">5 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis
                                                    laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi,
                                                    quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->
                            </div><!-- End .container -->
                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <div class="container">
                <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow owl-loaded owl-drag"
                    data-toggle="owl"
                    data-owl-options="{
                    &quot;nav&quot;: false,
                    &quot;dots&quot;: true,
                    &quot;margin&quot;: 20,
                    &quot;loop&quot;: false,
                    &quot;responsive&quot;: {
                        &quot;0&quot;: {
                            &quot;items&quot;:1
                        },
                        &quot;480&quot;: {
                            &quot;items&quot;:2
                        },
                        &quot;768&quot;: {
                            &quot;items&quot;:3
                        },
                        &quot;992&quot;: {
                            &quot;items&quot;:4
                        },
                        &quot;1200&quot;: {
                            &quot;items&quot;:4,
                            &quot;nav&quot;: true,
                            &quot;dots&quot;: false
                        }
                    }
                }">

                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(0px, 0px, 0px); transition: all; width: 1485px;">
                            @foreach ($relatedProducts as $relatedProduct)
                                <div class="owl-item active" style="width: 277px; margin-right: 20px;">
                                    <div class="product product-7">
                                        <figure class="product-media">
                                            <a href="{{ url('/' . $relatedProduct->slug) }}">
                                                <img src="/upload/product/{{ $relatedProduct->images->first()->image_name }}"
                                                    alt="Product image" class="product-image">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#"
                                                    class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                        wishlist</span></a>
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                                <a href="#" class="btn-product btn-cart"><span>add to
                                                        cart</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a
                                                    href="{{ url('/' . $relatedProduct->category->slug . '/' . $relatedProduct->subCategory->slug) }}">{{ $relatedProduct->subCategory->name }}</a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a
                                                    href="{{ url('/' . $relatedProduct->slug) }}">{{ $relatedProduct->title }}</a>
                                            </h3>
                                            <!-- End .product-title -->
                                            <div class="product-price">
                                                ${{ number_format($relatedProduct->price, 2) }}
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 20%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">( 2 Reviews )</span>
                                            </div><!-- End .rating-container -->
                                        </div><!-- End .product-body -->
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i
                                class="icon-angle-left"></i></button><button type="button" role="presentation"
                            class="owl-next"><i class="icon-angle-right"></i></button></div>
                    <div class="owl-dots disabled"></div>
                </div><!-- End .owl-carousel -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>
@endsection
@section('scripts')
    <script>
        $('.getSizePrice').change(function() {
            var price = $('option:selected', this).attr('data-price')
            price = number_format(price, 2);
            $('#totalPrice').html(price);

        })
    </script>
@endsection
