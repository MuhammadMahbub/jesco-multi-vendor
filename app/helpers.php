<?php
function allwishlist()
{
    return App\Models\Wishlist::where('user_id', auth()->id())->get();
}

function wishlistcheck($product_id)
{
    return App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product_id)->exists();
}

function allcarts()
{
    return App\Models\Cart::where('user_id', auth()->id())->get();
}

function totalproductsatcart()
{
    return App\Models\Cart::where('user_id', auth()->id())->count();
}

function totalprice()
{
    // return App\Models\Cart::where('user_id', auth()->id())->amount();
}

function totalreviews($product_id)
{
    return App\Models\Rating::where('product_id', $product_id)->count();
}

function ratingpercent($product_id)
{
    return App\Models\Rating::where('product_id', $product_id)->avg('rating') * 20;
}
