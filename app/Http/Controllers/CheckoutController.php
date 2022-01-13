<?php

namespace App\Http\Controllers;

use App\Models\Billing_details;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Order_detail;
use App\Models\Order_summery;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    function checkout(Request $request)
    {
        Session::put('s_shipping_total', $request->shipping);
        if (strpos(url()->previous(), 'cart') || strpos(url()->previous(), 'checkout')) {
            return view('frontend.checkout', [
                'countries' => Country::where('status', 'active')->get(['id', 'name']),
            ]);
        } else {
            return view('errors.404');
        }
    }

    function checkout_post(Request $request)
    {
        $request->validate([
            'order_notes' => 'nullable',
            '*' => 'required',
        ]);
        // print_r($request->session());
        $order_summery_id = Order_summery::insertGetId([
            'user_id' => auth()->id(),
            'cart_total' => session('s_cart_total'),
            'discount_total' => session('s_discount_total'),
            'sub_total' => session('s_cart_total') - session('s_discount_total'),
            'shipping_total' => session('s_shipping_total'),
            'grand_total' => session('s_cart_total') - session('s_discount_total') + session('s_shipping_total'),
            'payment_option' => $request->payment_option,
            'coupon_name' => session('s_coupon_name'),
            'created_at' => Carbon::now()
        ]);
        Billing_details::insert([
            'order_summery_id' => $order_summery_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'order_notes' => $request->message,
        ]);
        foreach (allcarts() as $cart) {
            Order_detail::insert([
                'order_summery_id' => $order_summery_id,
                'vendor_id' => $cart->vendor_id,
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
                'created_at' => Carbon::now()
            ]);
            Product::find($cart->product_id)->decrement('product_quantity', $cart->amount);
            // cart delete korte hobe
            // Cart::find($cart->id)->delete(); /*this line will be used*/
        }
        if (session('s_coupon_name')) {
            Coupon::where('coupon_name', session('s_coupon_name'))->decrement('limit', 1);
        }
        if ($request->payment_option == 0) {
            return redirect('home')->with('success', 'Purchase Successfull');
        } else {
            Session::put('s_order_summery_id', $order_summery_id);
            return redirect('/pay');
        }
    }

    function get_cities(Request $request)
    {
        $show_city = "<option value=''>Select City</option>";
        $cities = City::where('country_id', $request->country_id)->get(['id', 'name']);
        foreach ($cities as $city) {
            // echo $city->name .= "<option value='$city->id'>$city->name</option>";
            $show_city .= "<option value='$city->id'>$city->name</option>";
        }
        echo $show_city;
    }
}
