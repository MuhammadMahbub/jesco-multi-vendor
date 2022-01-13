<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from template.hasthemes.com/jesco/jesco/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 07:18:43 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <title>Jesco - Fashoin eCommerce HTML Template</title>
    <meta name="description" content="Jesco - Fashoin eCommerce HTML Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Add site Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets') }}/images/favicon/favicon.ico" type="image/png">
    <!-- Latest compiled and minified CSS -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/vendor/vendor.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/plugins/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/style.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/style.css" />

</head>

<body>

    <!-- Top Bar -->

    <div class="header-to-bar"> HELLO EVERYONE! 25% Off All Products </div>

    <!-- Top Bar -->
    <!-- Header Area Start -->
    <header>
        <div class="header-main sticky-nav ">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('index') }}"><img
                                    src="{{ asset('frontend/assets') }}/images/logo/logo.png" alt="Site Logo" /></a>
                        </div>
                    </div>
                    <div class="col align-self-center d-none d-lg-block">
                        <div class="main-menu">
                            <ul>
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Action Start -->
                    <div class="pl-0 col col-lg-auto align-self-center">
                        <div class="header-actions">
                            @auth
                                <a href="{{ route('home') }}"
                                    class="header-action-btn login-btn">{{ auth()->user()->name }}</a>
                            @else
                                <a href="{{ route('login') }}" class="header-action-btn login-btn" data-bs-toggle="modal"
                                    data-bs-target="#loginActive">Sign In</a>
                            @endauth
                            <!-- Single Wedge Start -->
                            <a href="#" class="header-action-btn" data-bs-toggle="modal" data-bs-target="#searchActive">
                                <i class="pe-7s-search"></i>
                            </a>
                            <!-- Single Wedge End -->
                            <!-- Single Wedge Start -->
                            <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                                <i class="pe-7s-like"></i>
                            </a>
                            <!-- Single Wedge End -->
                            <a href="#offcanvas-cart"
                                class="pr-0 header-action-btn header-action-btn-cart offcanvas-toggle">
                                <i class="pe-7s-shopbag"></i>
                                <span class="header-action-num">{{ totalproductsatcart() }}</span>
                                <!-- <span class="cart-amount">€30.00</span> -->
                            </a>
                            <a href="#offcanvas-mobile-menu"
                                class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                                <i class="pe-7s-menu"></i>
                            </a>
                            @auth
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                        <!-- Header Action End -->
                    </div>
                </div>
            </div>
    </header>
    <!-- Header Area End -->
    <div class="offcanvas-overlay"></div>

    <!-- OffCanvas Wishlist Start -->
    <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
        <div class="inner">
            <div class="head">
                <span class="title">Wishlist</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">
                    @forelse (allwishlist() as $wishlist)
                        <li>
                            <a href="{{ route('product.details', $wishlist->relationtoproduct->product_slug) }}"
                                class="image"><img
                                    src="{{ asset('uploads/product_photos') }}/{{ $wishlist->relationtoproduct->product_photo }}"
                                    alt="Cart product Image"></a>
                            <div class="content">
                                <a href="{{ route('product.details', $wishlist->relationtoproduct->product_slug) }}"
                                    class="title">{{ $wishlist->relationtoproduct->product_name }}</a>
                                <span class="quantity-price"><span
                                        class="amount">${{ $wishlist->relationtoproduct->product_price }}</span></span>
                                <a href="{{ route('wishlist.remove', $wishlist->id) }}" class="remove">×</a>
                            </div>
                        </li>
                    @empty
                        No Product
                    @endforelse
                </ul>
            </div>
            <div class="foot">
                <div class="buttons">
                    <a href="{{ route('wishlist.index') }}" class="btn btn-dark btn-hover-primary mt-30px">view
                        wishlist</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Wishlist End -->
    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title">Cart</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">
                    @forelse (allcarts() as $cart)
                        <li>
                            <a href="" class="image"><img
                                    src="{{ asset('uploads/product_photos') }}/{{ $cart->relationtoproduct->product_photo }}"
                                    alt="Cart product Image"></a>
                            <div class="content">
                                <a href="single-product.html"
                                    class="title">{{ $cart->relationtoproduct->product_name }}</a>
                                <span class="quantity-price">{{ $cart->amount }} x <span
                                        class="amount">${{ $cart->relationtoproduct->product_price }}</span></span>
                                <span
                                    class="text-danger">${{ $cart->amount * $cart->relationtoproduct->product_price }}</span>
                                <a href="{{ route('cart.remove', $cart->id) }}" class="remove">×</a>
                            </div>
                        </li>
                    @empty
                        no product
                    @endforelse
                </ul>
            </div>
            <div class="foot">
                <div class="buttons mt-30px">
                    <a href="{{ route('cart') }}" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Menu Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <button class="offcanvas-close"></button>

        <div class="inner customScroll">

            <div class="mb-4 offcanvas-menu">
                <ul>
                    <li><a href="#"><span class="menu-text">Home</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.html"><span class="menu-text">Home 1</span></a></li>
                            <li><a href="index-2.html"><span class="menu-text">Home 2</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="menu-text">Shop</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="#"><span class="menu-text">Shop Page</span></a>
                                <ul class="sub-menu">
                                    <li class="title"><a href="#">Shop Page</a></li>
                                    <li><a href="shop-3-column.html">Shop 3 Column</a></li>
                                    <li><a href="shop-4-column.html">Shop 4 Column</a></li>
                                    <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                    <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                    <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                    <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">product Details Page</span></a>
                                <ul class="sub-menu">
                                    <li><a href="single-product.html">Product Single</a></li>
                                    <li><a href="single-product-variable.html">Product Variable</a></li>
                                    <li><a href="single-product-affiliate.html">Product Affiliate</a></li>
                                    <li><a href="single-product-group.html">Product Group</a></li>
                                    <li><a href="single-product-tabstyle-2.html">Product Tab 2</a></li>
                                    <li><a href="single-product-tabstyle-3.html">Product Tab 3</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">Single Product Page</span></a>
                                <ul class="sub-menu">
                                    <li><a href="single-product-slider.html">Product Slider</a></li>
                                    <li><a href="single-product-gallery-left.html">Product Gallery Left</a>
                                    </li>
                                    <li><a href="single-product-gallery-right.html">Product Gallery Right</a>
                                    </li>
                                    <li><a href="single-product-sticky-left.html">Product Sticky Left</a></li>
                                    <li><a href="single-product-sticky-right.html">Product Sticky Right</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">Other Shop Pages</span></a>
                                <ul class="sub-menu">
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                    <li><a href="my-account.html">Account Page</a></li>
                                    <li><a href="login.html">Login & Register Page</a></li>
                                    <li><a href="empty-cart.html">Empty Cart Page</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">Pages</span></a>
                                <ul class="sub-menu">
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="faq.html">Faq Page</a></li>
                                    <li><a href="coming-soon.html">Coming Soon Page</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="menu-text">Blog</span></a>
                        <ul class="sub-menu">
                            <li><a href="blog-grid.html">Blog Grid Page</a></li>
                            <li><a href="blog-grid-left-sidebar.html">Grid Left Sidebar</a></li>
                            <li><a href="blog-grid-right-sidebar.html">Grid Right Sidebar</a></li>
                            <li><a href="blog-single.html">Blog Single Page</a></li>
                            <li><a href="blog-single-left-sidebar.html">Single Left Sidebar</a></li>
                            <li><a href="blog-single-right-sidebar.html">Single Right Sidbar</a>
                        </ul>
                    </li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
            <!-- OffCanvas Menu End -->
            <div class="mt-auto offcanvas-social">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
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
    <!-- OffCanvas Menu End -->

    <!-- Hero/Intro Slider Start -->

    @yield('content')

    <!-- Footer Area Start -->
    <div class="footer-area m-lrb-30px">
        <div class="footer-container">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-3 mb-md-30px mb-lm-30px">
                            <div class="single-wedge">
                                <div class="footer-logo">
                                    <a href="index.html"><img
                                            src="{{ asset('frontend/assets') }}/images/logo/logo-white.png"
                                            alt=""></a>
                                </div>
                                <p class="about-text">Lorem ipsum dolor sit amet consectet adipisicing elit, sed
                                    do
                                    eiusmod templ incididunt ut labore et dolore magnaol aliqua Ut enim ad minim.
                                </p>
                                <ul class="link-follow">
                                    <li>
                                        <a class="m-0" title="Twitter" href="#"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a title="Tumblr" href="#"><i class="fa fa-tumblr" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Instagram" href="#"><i class="fa fa-instagram"
                                                aria-hidden="true"></i>
                                            </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-sm-6 col-lg-2 mb-md-30px mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Quick Links</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="#">Support
                                                </a></li>
                                            <li class="li"><a class="single-link" href="#">Helpline</a>
                                            </li>
                                            <li class="li"><a class="single-link" href="#">Courses</a>
                                            </li>
                                            <li class="li"><a class="single-link"
                                                    href="about.html">About</a></li>
                                            <li class="li"><a class="single-link" href="#">Event</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-lg-2 col-sm-6 mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Other Page</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="about.html">
                                                    About </a>
                                            </li>
                                            <li class="li"><a class="single-link"
                                                    href="blog-grid.html">Blog</a></li>
                                            <li class="li"><a class="single-link" href="#">Speakers</a>
                                            </li>
                                            <li class="li"><a class="single-link"
                                                    href="contact.html">Contact</a></li>
                                            <li class="li"><a class="single-link" href="#">Tricket</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-lg-2 col-sm-6 mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Company</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link"
                                                    href="index.html">Jesco</a>
                                            </li>
                                            <li class="li"><a class="single-link"
                                                    href="shop-left-sidebar.html">Shop</a>
                                            </li>
                                            <li class="li"><a class="single-link"
                                                    href="contact.html">Contact us</a>
                                            </li>
                                            <li class="li"><a class="single-link" href="login.html">Log
                                                    in</a></li>
                                            <li class="li"><a class="single-link" href="#">Help</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-4 col-lg-3 col-sm-6">
                            <div class="single-wedge">

                                <h4 class="footer-herading">Store Information.</h4>
                                <div class="footer-links">
                                    <!-- News letter area -->
                                    <p class="address">2005 Your Address Goes Here. <br>
                                        896, Address 10010, HGJ</p>
                                    <p class="phone">Phone/Fax:<a href="tel:0123456789">0123456789</a></p>
                                    <p class="mail">Email:<a
                                            href="mailto:demo@example.com">demo@example.com</a></p>
                                    <img src="{{ asset('frontend/assets') }}/images/icons/payment.png" alt=""
                                        class="payment-img img-fulid">

                                    <!-- News letter area  End -->
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="text-center col-12">
                            <p class="copy-text"> © 2021 <strong>Jesco</strong> Made With <i
                                    class="fa fa-heart" aria-hidden="true"></i> By <a class="company-name"
                                    href="https://hasthemes.com/">
                                    <strong> HasThemes</strong></a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area End -->

    <!-- Search Modal Start -->
    <div class="modal popup-search-style" id="searchActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span
                aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="p-0 modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Search Your Product</h2>
                        <form class="navbar-form position-relative" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search here...">
                            </div>
                            <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- Login Modal Start -->
    <div class="modal popup-login-style" id="loginActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span
                aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="p-0 modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="login-content">
                            <h2>Log in</h2>
                            <h3>Log in your account</h3>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="email" placeholder="Email Address" name="email">
                                <input type="password" placeholder="Password" name="password">
                                <div class="remember-forget-wrap">
                                    <div class="forget-wrap">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                                <button type="submit">Log in</button>
                                <div class="member-register">
                                    <p> Not a member? <a href="{{ route('register') }}"> Register now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal End -->
    <!-- Modal -->
    {{-- <div class="modal modal-2 fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                            <!-- Swiper -->
                            <div class="swiper-container zoom-top">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/zoom-image/1.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/zoom-image/2.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/zoom-image/3.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/zoom-image/4.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-3 swiper-container zoom-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/small-image/1.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/small-image/2.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/small-image/3.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="m-auto img-responsive"
                                            src="{{ asset('frontend/assets') }}/images/product-image/small-image/4.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-details-content quickview-content">
                                <h2>Ardene Microfiber Tights</h2>
                                <div class="pricing-meta">
                                    <ul>
                                        <li class="old-price not-cut">$18.90</li>
                                    </ul>
                                </div>
                                <div class="pro-details-rating-wrap">
                                    <div class="rating-product">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="read-review"><a class="reviews" href="#">( 5 Customer
                                            Review
                                            )</a></span>
                                </div>
                                <p class="mb-0 mt-30px">Lorem ipsum dolor sit amet, consect adipisicing elit, sed do
                                    eiusmod tempor incidi ut labore
                                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita ullamco
                                    laboris nisi
                                    ut aliquip ex ea commodo </p>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button class="add-cart" href="#"> Add To
                                            Cart</button>
                                    </div>
                                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                        <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-details-compare-wishlist pro-details-compare">
                                        <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                                    </div>
                                </div>
                                <div class="pro-details-sku-info pro-details-same-style d-flex">
                                    <span>SKU: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#">Ch-256xl</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-details-categories-info pro-details-same-style d-flex">
                                    <span>Categories: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#">Fashion.</a>
                                        </li>
                                        <li>
                                            <a href="#">eCommerce</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-details-social-info pro-details-same-style d-flex">
                                    <span>Share: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
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
        </div>
    </div> --}}
    <!-- Modal end -->

    <!-- Global Vendor, plugins JS -->

    <!-- Vendor JS -->


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="{{ asset('frontend/assets') }}/js/vendor/vendor.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/plugins.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main Js -->
    <script src="{{ asset('frontend/assets') }}/js/main.js"></script>

    @yield('footer_scripts')

</body>


<!-- Mirrored from template.hasthemes.com/jesco/jesco/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 07:19:21 GMT -->

</html>
