<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        unlink(base_path('public/uploads/banner_photos/' . $banner->banner_photo));
        $banner->delete();
        return redirect()->route('banner.index')->with('delete', 'Banner Deleted Successfully');
    }
}
