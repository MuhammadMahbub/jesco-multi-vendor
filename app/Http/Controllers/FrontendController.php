<?php

namespace App\Http\Controllers;

use App\Models\{Category, Product};
// use App\Models\Product;
use App\Models\Banner;
use App\Models\Deal;
use App\Models\Rating;
use App\Models\Wishlist;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function index()
    {
        $deals = Deal::all();
        $categories = Category::where('status', 'show')->get();
        $allproducts = Product::all();
        $banners = Banner::where('status', 'show')->limit(3)->get();
        return view('frontend.index', compact('categories', 'allproducts', 'banners', 'deals'));
    }
    function contact()
    {
        return view('frontend.contact');
    }
    function shop()
    {
        if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
            $min = $_GET['min_price'];
            $max = $_GET['max_price'];
            $categories = Category::where('status', 'show')->get();
            $sizes = Size::all();
            $allproducts = Product::whereBetween('product_price', [$_GET['min_price'], $_GET['max_price']])
                ->get();
            return view('frontend.shop', compact('categories', 'allproducts', 'min', 'max', 'sizes'));
        } else {
            $min = "";
            $max = "";
            $sizes = Size::all();
            $categories = Category::where('status', 'show')->get();
            $allproducts = Product::all();
            return view('frontend.shop', compact('categories', 'allproducts', 'min', 'max', 'sizes'));
        }
    }

    // function productsize($product_size)
    // {
    //     foreach (Size::where('size', $product_size)->get() as $item) {
    //         echo $allproducts = Product::find($item->product_id)->product_photo;
    //     };
    //     dd();
    //     $min = "";
    //     $max = "";
    //     $sizes = Size::all();
    //     $categories = Category::where('status', 'show')->get();
    //     foreach (Size::where('size', $product_size)->get() as $item) {
    //         $allproducts = Product::find($item->product_id);
    //     };
    //     return view('frontend.shop', compact('categories', 'allproducts', 'min', 'max', 'sizes'));
    // }

    function product_details($slug)
    {
        $wishlist_status = Wishlist::where('user_id', auth()->id())->where('product_id', Product::where('product_slug', $slug)->first()->id)->exists();
        if ($wishlist_status) {
            $wishlist_id = Wishlist::where('user_id', auth()->id())->where('product_id', Product::where('product_slug', $slug)->first()->id)->first()->id;
        } else {
            $wishlist_id = "";
        }
        $cat_id = Product::where('product_slug', $slug)->firstOrFail()->category_id;
        $related_products = Product::where('product_slug', '!=', $slug)->where('category_id', $cat_id)->get();
        $productdetails = Product::where('product_slug', $slug)->firstOrFail();
        $reviews = Rating::where('product_id', Product::where('product_slug', $slug)->firstOrFail()->id)->get();
        return view('frontend.productdetails', compact('productdetails', 'related_products', 'wishlist_status', 'wishlist_id', 'reviews'));
    }

    function categorywiseproducts($category_id)
    {
        $category_name = Category::findOrFail($category_id);
        $categorywiseproducts =  Product::where('category_id', $category_id)->get();
        return view('frontend.categorywiseproducts', compact('categorywiseproducts', 'category_name'));
    }

    function alldeals()
    {
        $alldeals = Deal::where('validity', '>', Carbon::now())->get();
        $expiredeals = Deal::where('validity', '<', Carbon::now())->get();

        if ($alldeals) {
            return view('frontend.alldeals', compact('alldeals'));
        } else {
            foreach ($expiredeals as $exp) {
                Deal::find($exp->id)->delete();
            }
            return view('frontend.alldeals');
        }
    }

    function productdeal()
    {
        $products = Product::where('user_id', Auth::id())->where('product_discount', '!=', NULL)->get();
        return view('frontend.deal', compact('products'));
    }

    function dealstore(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'validity' => 'date|after:today',
        ]);

        Deal::insert([
            'product_id' => $request->product_id,
            'vendor_id' => Auth::user()->id,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);
        return redirect('home');
    }
}
