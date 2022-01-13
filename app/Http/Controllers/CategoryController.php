<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            '*' => 'required',
        ]);

        $ext = $request->file('category_photo')->getClientOriginalExtension();
        $new_name = Auth::id() . '-' . uniqid() . '.' . $ext;
        Image::make($request->file('category_photo'))->resize(600, 328)->save(base_path('public/uploads/category_photos/' . $new_name));


        Category::insert([
            'category_name' => $request->category_name,
            'category_tagline' => $request->category_tagline,
            'category_photo' => $new_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('category.index')->with('success', 'Category Added Successfully');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show', compact('category'));
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->hasFile('new_category_photo')) {
            unlink(base_path('public/uploads/category_photos/' . $category->category_photo));
            $ext = $request->file('new_category_photo')->getClientOriginalExtension();
            $new_name = $category->id . '-' . uniqid() . '.' . $ext;
            Image::make($request->file('new_category_photo'))->resize(600, 328)->save(base_path('public/uploads/category_photos/' . $new_name));

            $category->update([
                'category_photo' => $new_name,
            ]);
        }

        $category->update([
            'category_name' => $request->category_name,
            'category_tagline' => $request->category_tagline,
            'status' => $request->status,
        ]);
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        unlink(base_path('public/uploads/category_photos/' . $category->category_photo));
        $category->delete();
        return back()->with('delete', 'Category Deleted Successfully');
    }
}
