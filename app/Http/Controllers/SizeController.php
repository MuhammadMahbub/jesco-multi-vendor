<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SizeController extends Controller
{
    public function index()
    {
        return view('size.index', [
            'sizes' => Size::all(),
        ]);
    }

    public function create()
    {
        $products = Product::all();
        return view('size.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'size'       => 'required',
            'quantity'   => 'required|numeric',
        ]);

        Size::insert([
            'product_id' => $request->product_id,
            'size'       => $request->size,
            'quantity'   => $request->quantity,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('size.index')->with('success', 'Size Added');
    }

    public function show(Size $size)
    {
        //
    }

    public function edit(Size $size)
    {
        //
    }

    public function update(Request $request, Size $size)
    {
        //
    }

    public function destroy($id)
    {
        Size::find($id)->delete();
        return back()->with('delete', 'Size Deleted Successfully');
    }
}
