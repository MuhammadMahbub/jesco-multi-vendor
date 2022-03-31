<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    public function index()
    {
        return view('product.index', [
            'products' => Product::where('user_id', auth()->id())->get(),
        ]);
    }


    public function create()
    {
        $category = Category::where('status', 'show')->get();
        return view('product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->product_name) . "-" . Str::random(9);
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_photo' => 'required',
        ]);

        $ext = $request->file('product_photo')->getClientOriginalExtension();
        $new_name = Auth::id() . '-' . uniqid() . '.' . $ext;
        Image::make($request->file('product_photo'))->resize(270, 310)->save(base_path('public/uploads/product_photos/' . $new_name));

        $product_id = Product::insertGetId([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'product_code' => $request->product_code,
            'product_photo' => $new_name,
            'product_slug' => $slug,
            'product_quantity' => $request->product_quantity,
            'created_at' => Carbon::now(),
        ]);

        foreach ($request->file('product_thumbnail') as $product_thumbnail) {
            $ext = $product_thumbnail->getClientOriginalExtension();
            $thumbnail_name = $product_id . '-' . uniqid() . '.' . $ext;
            Image::make($product_thumbnail)->resize(800, 800)->save(base_path('public/uploads/product_thumbnails/' . $thumbnail_name));

            Product_Thumbnail::insert([
                'product_id' => $product_id,
                'product_thumbnail_name' => $thumbnail_name,
                'created_at' => Carbon::now(),
            ]);
        };
        return redirect()->route('product.index')->with('success', 'Product Added');
    }


    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        unlink(base_path('public/uploads/product_photos/' . $product->product_photo));
        $product->delete();
        return back()->with('delete', 'Product Deleted Successfully');
    }
}
