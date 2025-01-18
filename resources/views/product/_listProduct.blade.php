<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach ($products as $product)
            @php
                $getProductImage = $product->getImageSingle();
            @endphp
            <div class="col-6 col-md-4 col-lg-4">
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="{{ url('/' . $product->slug) }}">
                            <img src="/upload/product/{{ $getProductImage->image_name }}" alt="Product image"
                                class="product-image" style="aspect-ratio: 1/1; object-fit: cover;">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a
                                href="{{ url('/' . $product->category->slug . '/' . $product->subCategory->slug) }}">{{ $product->subCategory->name }}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{ url('/' . $product->slug) }}">{{ $product->title }}</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            ${{ number_format($product->price, 2) }}
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div>
                                <!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .col-sm-6 col-lg-4 -->
        @endforeach

    </div><!-- End .row -->
    @if (count($products) < 1)
        <p class="text-center">No Products in this category</p>
    @endif
</div><!-- End .products -->
