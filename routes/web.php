<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProfileController,
    SocialiteController,
    CategoryController,
    FrontendController,
    VendorController,
    ProductController,
    BannerController,
    WishlistController,
    CartController,
    CouponController,
    CheckoutController,
    SizeController,
    ContactController
};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SslCommerzPaymentController;

Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact/message', [ContactController::class, 'contactmessage'])->name('contact.message');
Route::get('/product/size/{product_size}', [FrontendController::class, 'productsize'])->name('product.size');
Route::get('/product/deal', [FrontendController::class, 'productdeal'])->name('deal.index');
Route::get('/product/alldeals', [FrontendController::class, 'alldeals'])->name('all.deals');
Route::post('/product/deal/store', [FrontendController::class, 'dealstore'])->name('deal.store');
// Route::post('/price_filter', [FrontendController::class, 'price_filter'])->name('price_filter');
Route::get('product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::get('categorywise/{category_id}', [FrontendController::class, 'categorywiseproducts'])->name('categorywiseproducts');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/email_offer', [HomeController::class, 'email_offer'])->name('email_offer');
Route::get('/single_email_offer/{id}', [HomeController::class, 'single_email_offer'])->name('single_email_offer');
Route::post('/multi_email_offer', [HomeController::class, 'multi_email_offer'])->name('multi_email_offer');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/name_change', [ProfileController::class, 'name_change'])->name('name_change');
Route::post('/change_password', [ProfileController::class, 'change_password'])->name('change_password');
Route::post('/profile_photo_change', [ProfileController::class, 'profile_photo_change'])->name('profile_photo_change');

//socialite
Route::prefix('google')->group(function () {
    Route::get('login', [SocialiteController::class, 'googleRedirect'])->name('googleRedirect');
    Route::get('callback', [SocialiteController::class, 'googleCallback'])->name('googleCallback');
});

// resource
Route::resource('banner', BannerController::class);
Route::resource('category', CategoryController::class);
Route::resource('vendor', VendorController::class);
Route::resource('product', ProductController::class);
Route::resource('wishlist', WishlistController::class);
Route::resource('coupon', CouponController::class);
Route::resource('size', SizeController::class);

Route::get('/wishlist/insert/{product_id}', [WishlistController::class, 'insert'])->name('wishlist.insert');
Route::get('/wishlist/remove/{wishlist_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/wishlisttocart/{wishlist_id}', [CartController::class, 'wishlisttocart'])->name('wishlisttocart');
Route::post('/addtocart/{product_id}', [CartController::class, 'addtocart'])->name('addtocart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/clear/shopping/cart/{user_id}', [CartController::class, 'clearshoppingcart'])->name('clearshoppingcart');
Route::post('/cart/update/', [CartController::class, 'cartupdate'])->name('cartupdate');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/post', [CheckoutController::class, 'checkout_post'])->name('checkout_post');
Route::post('/get/cities', [CheckoutController::class, 'get_cities'])->name('get_cities');
Route::get('/location', [HomeController::class, 'location'])->name('location');
Route::post('/location/update', [HomeController::class, 'locationupdate'])->name('location.update');
Route::post('/location/update', [HomeController::class, 'locationupdate'])->name('location.update');
Route::get('/all/orders', [HomeController::class, 'allorders'])->name('all.orders');
Route::get('/mark/received/{order_summery_id}', [HomeController::class, 'markreceived'])->name('mark.received');
Route::post('/review/rating/{order_detail_id}', [HomeController::class, 'reviewrating'])->name('review.rating');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// my orders
Route::get('/my_order/index', [HomeController::class, 'my_order'])->name('my_order.index');
Route::get('/my_order/details/{order_summery_id}', [HomeController::class, 'my_order_details'])->name('my_order_details');
Route::get('/invoice/download', [HomeController::class, 'invoicedownload'])->name('invoice.download');
Route::get('/invoice/download/excel', [HomeController::class, 'invoicedownloadexcel'])->name('invoice.download.excel');
