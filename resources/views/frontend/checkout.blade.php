@extends('layouts.app_front')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="text-center col-12">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->


    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <form action="{{ route('checkout_post') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Billing Details</h3>
                            @if ($errors->any())
                                <div class="alert alert-dark">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            @auth
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4 billing-info">
                                            <label>Name</label>
                                            <input type="text" value="{{ auth()->user()->name }}" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4 billing-info">
                                            <label>Email</label>
                                            <input type="text" value="{{ auth()->user()->email }}" name="email" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-4 billing-info">
                                            <label>Phone Number</label>
                                            <input type="text" value="{{ auth()->user()->phone }}" name="phone"
                                                class="@error('phone') 'is-invalid' @enderror">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-4 billing-select">
                                            <label>Country</label>
                                            <select name="country" id="country_dropdown" class="form-control">
                                                <option value=''>Select a country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-4 billing-select">
                                            <label>City</label>
                                            <select name="city" id="city_dropdown">
                                                <option value="">Select Country First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-4 billing-info">
                                            <label>Address</label>
                                            <input name="address" class="billing-address"
                                                placeholder="House number and street name" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4 billing-info">
                                            <label>Postcode / ZIP</label>
                                            <input type="text" name="postcode" />
                                        </div>
                                    </div>
                                </div>
                            @endauth
                            <div class="col-lg-12">
                                <div class="mb-4 billing-select">
                                    <label>Payment</label>
                                    <select name="payment_option">
                                        <option value="0">Cash On Delivery</option>
                                        <option value="1">Online Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="additional-info-wrap">
                                <h4>Additional information</h4>
                                <div class="additional-info">
                                    <label>Order notes</label>
                                    <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                        name="message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-product-info">
                                    <div class="your-order-top">
                                        <ul>
                                            <li>Product</li>
                                            <li>Total</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @forelse (allcarts() as $cart)
                                                <li><span
                                                        class="order-middle-left">{{ $cart->relationtoproduct->product_name }}
                                                        X {{ $cart->amount }}</span> <span
                                                        class="order-price">${{ $cart->relationtoproduct->product_price * $cart->amount }}
                                                    </span>
                                                </li>
                                            @empty
                                                no cart
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Cart Total</li>
                                            <li>${{ Session::get('s_cart_total') }}</li>
                                        </ul>
                                        <ul>
                                            <li class="your-order-shipping">Discount Total</li>
                                            <li>${{ Session::get('s_discount_total') }}</li>
                                        </ul>
                                        <ul>
                                            <li class="your-order-shipping">Sub Total</li>
                                            <li>${{ Session::get('s_cart_total') - Session::get('s_discount_total') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Shipping</li>
                                            <li>${{ Session::get('s_shipping_total') }}</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-total">
                                        <ul>
                                            <li class="order-total">Grand Total</li>{{ session('s_coupon_name') }}
                                            <li>${{ Session::get('s_cart_total') - Session::get('s_discount_total') + Session::get('s_shipping_total') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="Place-order mt-25">
                                <input class="btn btn-info" type="submit" value="Place Order" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout area end -->
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('#country_dropdown').select2();
            $('#country_dropdown').change(function() {

                var country_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/get/cities',
                    data: {
                        country_id: country_id
                    },
                    success: function(data) {
                        $('#city_dropdown').html(data)
                    }
                })
            });
        });
    </script>
@endsection
