@extends('layouts.app_front')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="text-center col-12">
                    <h2 class="breadcrumb-title">Products</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">
                            {{ App\Models\Category::find($productdetails->category_id)->category_name }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Product Details Area Start -->
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <!-- Swiper -->
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">
                            @foreach (App\Models\Product_Thumbnail::where('product_id', $productdetails->id)->get() as $thumbnail)
                                <div class="swiper-slide zoom-image-hover">
                                    <img class="m-auto img-responsive"
                                        src="{{ asset('uploads/product_thumbnails') }}/{{ $thumbnail->product_thumbnail_name }}"
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-3 mb-3 swiper-container zoom-thumbs">
                        <div class="swiper-wrapper">
                            @foreach (App\Models\Product_Thumbnail::where('product_id', $productdetails->id)->get() as $thumbnail)
                                <div class="swiper-slide">
                                    <img class="m-auto img-responsive"
                                        src="{{ asset('uploads/product_thumbnails') }}/{{ $thumbnail->product_thumbnail_name }}"
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        @if (session('stockout'))
                            <div class="alert alert-dark">{{ session('stockout') }}</div>
                        @endif
                        <h2>{{ $productdetails->product_name }}</h2>
                        <h5>Available Stock: <span class="text-success">{{ $productdetails->product_quantity }}</span>
                        </h5>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">${{ $productdetails->product_price }}</li>
                            </ul>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star"
                                            style="width: {{ ratingpercent($productdetails->id) }}%"></span>
                                    </span>
                                    <span class="rating-num">( {{ totalreviews($productdetails->id) }}
                                        Reviews)</span>
                                </span>
                                <style>
                                    .ratings {
                                        display: flex;
                                        align-items: flex-start;
                                        margin-bottom: 4px
                                    }

                                    .ratings .rating-wrap {
                                        font-size: 14px;
                                        line-height: 1;
                                        position: relative;
                                        color: #e4e4e4;
                                        white-space: nowrap
                                    }

                                    .ratings .rating-wrap::before {
                                        font-family: FontAwesome;
                                        content: "    "
                                    }

                                    .ratings .rating-wrap .star {
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        overflow: hidden;
                                        color: #ffde00
                                    }

                                    .ratings .rating-wrap .star::before {
                                        font-family: FontAwesome;
                                        content: "    "
                                    }

                                    .ratings .rating-num {
                                        font-size: 14px;
                                        line-height: 1;
                                        margin-left: 6px;
                                        color: #9f9e9e
                                    }

                                </style>
                            </div>
                        </div>

                        <div>
                            <p class="mt-3">{{ $productdetails->product_short_description }}</p>
                        </div>
                        <form action="{{ route('addtocart', $productdetails->id) }}" method="post">
                            <div class="pro-details-quality">
                                @csrf
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                </div>
                                <div class="pro-details-cart">
                                    <button class="add-cart" type="submit"> Add To
                                        Cart</button>
                                </div>
                        </form>
                        @auth
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                @if ($wishlist_status)
                                    <a href="{{ route('wishlist.remove', $wishlist_id) }}"
                                        class="header-action-btn login-btn"><i class="fa fa-heart text-danger"></i></a>
                                @else
                                    <a href="{{ route('wishlist.insert', $productdetails->id) }}"
                                        class="header-action-btn login-btn"><i class="fa fa-heart-o"></i></a>
                                @endif
                            </div>
                        @else
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                <a href="{{ route('login') }}" class="header-action-btn login-btn" data-bs-toggle="modal"
                                    data-bs-target="#loginActive"><i class="pe-7s-like"></i></a>
                            </div>
                        @endauth

                    </div>
                    <div class="pro-details-sku-info pro-details-same-style d-flex">
                        <span>Code</span>
                        <ul class="d-flex">
                            <li>
                                <a href="#">{{ $productdetails->product_code }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex">
                        <span>Categories: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="{{ route('categorywiseproducts', $productdetails->category_id) }}">
                                    {{-- {{ App\Models\Category::find($productdetails->category_id)->category_name }} --}}
                                    {{ $productdetails->relationtocategory->category_name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-social-info pro-details-same-style d-flex">
                        <span>Share: </span>
                        <ul class="d-flex">
                            <li>
                                <a target="_blank" href="http://www.facebook.com/sharer.php?u={{ url()->full() }}"><i
                                        class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="http://twitter.com/share?url={{ url()->full() }}" target="_blank"><i
                                        class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- product details description area start -->
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews ({{ totalreviews($productdetails->id) }})</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">
                            <ul>
                                <li><span>Weight</span> 400 g</li>
                                <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                                <li><span>Materials</span> 60% cotton, 40% polyester</li>
                                <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>{{ $productdetails->product_long_description }}</p>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="review-wrapper">
                                    @foreach ($reviews as $review)
                                        <div class="single-review">
                                            <div class="review-img">
                                                <img src="{{ asset('uploads/profile_photos/default.jpg') }}" alt=""
                                                    width="100" />
                                            </div>
                                            <div class="review-content">
                                                <div class="review-top-wrap">
                                                    <div class="review-left">
                                                        <div class="review-name">
                                                            <h4>{{ App\Models\User::find($review->user_id)->name }}</h4>
                                                        </div>
                                                        <div class="rating-product">
                                                            <span class="ratings">
                                                                <span class="rating-wrap">
                                                                    <span class="star"
                                                                        style="width: {{ $review->rating * 20 }}%"></span>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-bottom">
                                                    <p>
                                                        {{ $review->review }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details description area end -->

    <!-- Related product Area Start -->
    <div class="related-product-area pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center section-title mb-30px0px line-height-1">
                        <h2 class="m-0 title">Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                <div class="new-product-wrapper swiper-wrapper">
                    @forelse ($related_products as $related_product)
                        <div class="new-product-item swiper-slide">
                            <!-- Single Prodect -->
                            <div class="product">
                                <div class="thumb">
                                    <a href="single-product.html" class="image">
                                        <img src="{{ asset('uploads/product_photos') }}/{{ $related_product->product_photo }}"
                                            alt="Product" />
                                        <img class="hover-image" src="assets/images/product-image/6.jpg" alt="Product" />
                                    </a>
                                    <span class="badges">
                                        <span class="new">New</span>
                                    </span>
                                    <div class="actions">
                                        <a href="{{ route('product.details', $related_product->product_slug) }}"
                                            class="action wishlist" title="Wishlist">
                                            <i
                                                class="{{ wishlistcheck($related_product->id) ? 'fa fa-heart text-danger' : 'fa fa-heart-o' }}"></i>
                                        </a>
                                        <a href="#" class="action quickview" data-link-action="quickview"
                                            title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="pe-7s-search"></i></a>
                                    </div>
                                    <a href="{{ route('product.details', $related_product->product_slug) }}"
                                        title="Add To Cart" class=" add-to-cart">Add
                                        To Cart</a>
                                </div>
                                <div class="content">
                                    <span class="ratings">
                                        <span class="rating-wrap">
                                            <span class="star" style="width: 100%"></span>
                                        </span>
                                        <span class="rating-num">( 5 Review )</span>
                                    </span>
                                    <h5 class="title"><a
                                            href="{{ route('product.details', $related_product->product_slug) }}">{{ $related_product->product_name }}</a>
                                    </h5>
                                    <span class="price">
                                        <span class="new">${{ $related_product->product_price }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-dark">No Records</div>
                    @endforelse
                </div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Related product Area End -->
@endsection
