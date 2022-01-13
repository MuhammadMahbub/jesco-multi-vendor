<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function wishlisttocart($wishlist_id)
    {
        $product_id = Wishlist::find($wishlist_id)->first()->product_id;
        $vendor_id = Product::find($product_id)->user_id;
        $esists = Cart::where('user_id', auth()->id())->where('product_id', $product_id)->exists();
        if ($esists) {
            Cart::where('user_id', auth()->id())->where('product_id', $product_id)->increment('amount', 1);
        } else {
            Cart::insert([
                'user_id' => auth()->id(),
                'vendor_id' => $vendor_id,
                'product_id' => $product_id,
                'created_at' => Carbon::now()
            ]);
            Wishlist::find($wishlist_id)->delete();
        }


        return back();
    }
    public function addtocart(Request $request, $product_id)
    {
        if (Product::find($product_id)->product_quantity < $request->qtybutton) {
            return back()->with('stockout', 'Stock Not Available');
        } else {
            if (Cart::where('user_id', auth()->id())->where('product_id', $product_id)->exists()) {
                if (Product::find($product_id)->product_quantity < Cart::where('user_id', auth()->id())->where('product_id', $product_id)->first()->amount + $request->qtybutton) {
                    return back()->with('stockout', 'Stock Not Available');
                };
                Cart::where('user_id', auth()->id())->where('product_id', $product_id)->increment('amount', $request->qtybutton);
            } else {
                Cart::insert([
                    'user_id' => auth()->id(),
                    'vendor_id' => Product::find($product_id)->user_id, //vendor_id
                    'product_id' => $product_id,
                    'amount' => $request->qtybutton,
                    'created_at' => Carbon::now()
                ]);
            }
        }

        return back();
    }

    public function cart()
    {
        if (isset($_GET['coupon_name'])) {
            $coupon_name = $_GET['coupon_name'];
            if ($_GET['coupon_name']) {
                if (Coupon::where('coupon_name', $_GET['coupon_name'])->exists()) {
                    $coupon_info = Coupon::where('coupon_name', $_GET['coupon_name'])->first();
                    if ($coupon_info->limit != 0) {
                        if ($coupon_info->validity > Carbon::today()->format('Y-m-d')) {
                            $discount = round(session('s_cart_total') * ($coupon_info->discount) / 100);
                        } else {
                            $discount = 0;
                            return redirect('cart')->with('coupon_error', $coupon_name . ' ' . 'validity is over');
                        }
                    } else {
                        $discount = 0;
                        return redirect('cart')->with('coupon_error', $coupon_name . ' ' . 'limit is over');
                    }
                } else {
                    $discount = 0;
                    return redirect('cart')->with('coupon_error', 'ei name kono coupon nai');
                }
            } else {
                $discount = 0;
                $coupon_name = '';
            }
        } else {
            $discount = 0;
            $coupon_name = '';
        }
        return view('frontend.cart', compact('discount', 'coupon_name'));
    }

    public function clearshoppingcart($user_id)
    {

        Cart::where('user_id', $user_id)->delete();
        return back();
    }
    public function cartupdate(Request $request)
    {
        foreach ($request->qtybutton as $cart_id => $updated_amount) {
            if ($updated_amount > Product::find(Cart::find($cart_id)->product_id)->product_quantity) {
                $product_name = Product::find(Cart::find($cart_id)->product_id)->product_name;
                return back()->with('stockout', "$product_name-- Stock Not Available");
            } else {
                Cart::find($cart_id)->update([
                    'amount' => $updated_amount
                ]);
            }
        };
        return back();
    }

    public function remove($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back();
    }
}
