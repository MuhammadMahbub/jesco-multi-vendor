<div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
    <!-- Single Prodect -->
    <div class="product">
        <div class="thumb">
            <a href="single-product.html" class="image">
                <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="Product" />
            </a>
            <span class="badges">
                <span class="new">New</span>
            </span>
            <div class="actions">
                <a href="{{ route('product.details', $product->product_slug) }}" class="action wishlist"
                    title="Wishlist">
                    <i class="{{ wishlistcheck($product->id) ? 'fa fa-heart text-danger' : 'fa fa-heart-o' }}"></i>
                </a>
                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
            </div>
            <a href="{{ route('product.details', $product->product_slug) }}" title="Add To Cart"
                class=" add-to-cart">Add
                To Cart</a>
        </div>
        <div class="content">
            <span class="ratings">
                <span class="rating-wrap">
                    <span class="star" style="width: {{ ratingpercent($product->id) }}%"></span>
                </span>
                <span class="rating-num">( {{ totalreviews($product->id) }} Reviews)</span>
            </span>
            <h5 class="title"><a
                    href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
            </h5>
            @if ($product->product_discount == null)
                <span class="price">
                    <span class="new">${{ $product->product_price }}</span>
                </span>
            @else
                <span class="price">
                    <span class="new">$<del>{{ $product->product_price }}</del></span>
                    --Now:<span
                        class="new">${{ $product->product_price - ($product->product_price * $product->product_discount) / 100 }}</span>
                </span>
            @endif
            <span class="price">
                <span class="new">Vendor:
                    {{-- {{ App\Models\User::find($product->user_id)->name }} --}}
                    {{ $product->relationtouser->name }}
                </span>
            </span>
        </div>
    </div>
</div>
