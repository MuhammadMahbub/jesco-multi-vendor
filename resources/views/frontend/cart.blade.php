@extends('layouts.app_front')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="text-center col-12">
                    <h2 class="breadcrumb-title">Cart</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            @if (session('stockout'))
                <div class="alert alert-warning">{{ session('stockout') }}</div>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ route('cartupdate') }}" method="POST">
                        @csrf
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Until Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cart_total = 0;
                                        $flag = false;
                                    @endphp
                                    @forelse (allcarts() as $cart)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a
                                                    href="{{ route('product.details', $cart->relationtoproduct->product_slug) }}"><img
                                                        class="img-responsive ml-15px"
                                                        src="{{ asset('uploads/product_photos') }}/{{ $cart->relationtoproduct->product_photo }}"
                                                        alt="" /></a>
                                            </td>
                                            <td class="product-name">
                                                <a
                                                    href="{{ route('product.details', $cart->relationtoproduct->product_slug) }}">{{ $cart->relationtoproduct->product_name }}<br>
                                                    Vendor: {{ $cart->relationtouser->name }}<br>
                                                    @if ($cart->relationtoproduct->product_quantity < $cart->amount)
                                                        <span class="text-danger">Stock Out</span>
                                                        @php
                                                            $flag = true;
                                                        @endphp
                                                    @else
                                                        <span class="text-info">Available</span>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="product-price-cart"><span
                                                    class="amount">${{ $cart->relationtoproduct->product_price }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text"
                                                        name="qtybutton[{{ $cart->id }}]"
                                                        value="{{ $cart->amount }}" />
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                ${{ $cart->relationtoproduct->product_price * $cart->amount }}</td>
                                            <td class="product-remove">
                                                <a href="{{ route('cart.remove', $cart->id) }}"><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $cart_total += $cart->relationtoproduct->product_price * $cart->amount;
                                        @endphp
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ route('index') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit">Update Shopping Cart</button>
                                        @auth
                                            <a href="{{ route('clearshoppingcart', auth()->id()) }}">Clear Shopping Cart</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input id="coupon_name" type="text" name="coupon_name"
                                            value="{{ $coupon_name ? $coupon_name : '' }}" />
                                        @if (session('coupon_error'))
                                            <div class="alert alert-danger">{{ session('coupon_error') }}</div>
                                        @endif
                                        <button id="coupon" class="cart-btn-2" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mt-md-30px">
                            <form method="post" action="{{ route('checkout') }}">
                                @csrf
                                <div class=" grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                    </div>
                                    @php
                                        if ($coupon_name) {
                                            Session::put('s_coupon_name', $coupon_name);
                                        } else {
                                            Session::put('s_coupon_name', '');
                                        }

                                        Session::put('s_cart_total', $cart_total);
                                        Session::put('s_discount_total', $discount);
                                    @endphp
                                    <h5>Total Price <span>${{ $cart_total }}</span></h5>
                                    <h5>Discount Price({{ $coupon_name ? $coupon_name : 'N\A' }})
                                        <span>${{ $coupon_name ? $discount : '0' }}</span>
                                    </h5>
                                    <h5>Sub Total <span>$<span id="sub_total">{{ $cart_total - $discount }}</span></span>
                                    </h5>
                                    <div class="total-shipping">
                                        <h5>Total shipping</h5>
                                        <ul>
                                            <li><input type="radio" name="shipping" id="btn_1" value="50" /> Standard
                                                <span>$50.00</span>
                                            </li>
                                            <li><input type="radio" name="shipping" id="btn_2" value="100" /> Express
                                                <span>$100.00</span>
                                            </li>
                                            <li><input type="radio" name="shipping" id="btn_3" value="0" /> Free
                                                <span>$00.00</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <h4 class="grand-totall-title">Grand Total
                                        <span>$<span id="grand_total">{{ $cart_total - $discount }}</span></span>
                                    </h4>
                                    @if ($flag)
                                        <div class="alert alert-danger">Please remove stock out products</div>
                                    @else
                                        <input type="submit" value="Proceed to Checkout" class="btn btn-info d-none"
                                            id="checkput_btn"></input>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection

@section('footer_scripts')
    <script>
        $('#btn_1').click(function() {
            // alert(parseInt($('#sub_total').html()) + parseInt($(this).val()))
            $('#grand_total').html(parseInt($('#sub_total').html()) + parseInt($(this).val()));
            $('#checkput_btn').removeClass('d-none');
        })
        $('#btn_2').click(function() {
            $('#grand_total').html(parseInt($('#sub_total').html()) + parseInt($(this).val()));
            $('#checkput_btn').removeClass('d-none');
        })
        $('#btn_3').click(function() {
            $('#grand_total').html(parseInt($('#sub_total').html()) + parseInt($(this).val()));
            $('#checkput_btn').removeClass('d-none');
        })
    </script>
@endsection
