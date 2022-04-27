<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index', compact('banners'));
    }

    public function create()
    {
        return view('banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $ext = $request->file('banner_photo')->getClientOriginalExtension();
        $new_name = Auth::id() . '-' . uniqid() . '.' . $ext;
        Image::make($request->file('banner_photo'))->resize(514, 583)->save(base_path('public/uploads/banner_photos/' . $new_name));


        Banner::insert([
            'banner_heading' => $request->banner_heading,
            'banner_offer' => $request->banner_offer,
            'banner_photo' => $new_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('banner.index')->with('success', 'Banner Added Successfully');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        if ($request->hasFile('new_banner_photo')) {
            unlink(base_path('public/uploads/banner_photos/' . $banner->banner_photo));
            $ext = $request->file('new_banner_photo')->getClientOriginalExtension();
            $new_name = $banner->id . '-' . uniqid() . '.' . $ext;
            Image::make($request->file('new_banner_photo'))->resize(514, 583)->save(base_path('public/uploads/banner_photos/' . $new_name));

            $banner->update([
                'banner_photo' => $new_name,
            ]);
        }

        $banner->update([
            'status' => $request->status,
            'banner_heading' => $request->banner_heading,
            'banner_offer' => $request->banner_offer,
        ]);
        return redirect()->route('banner.index')->with('success', 'Banner Updated Successfully');
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        unlink(base_path('public/uploads/banner_photos/' . $banner->banner_photo));
        $banner->delete();
        return redirect()->route('banner.index')->with('delete', 'Banner Deleted Successfully');
    }
}
