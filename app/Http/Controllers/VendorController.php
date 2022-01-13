<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorNotification;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $vendors = Vendor::all();
        return view('vendor.index', compact('vendors'));
    }


    public function create()
    {
        return view('vendor.create');
    }


    public function store(Request $request)
    {
        $random_password = Str::random(8);
        $request->validate([
            '*' => 'required',
        ]);

        $user_info = User::create([
            'name' => $request->vendor_name,
            'email' => $request->vendor_email,
            'phone' => $request->vendor_phone_number,
            'password' => bcrypt($random_password),
            'role' => 3,
            'created_at' => Carbon::now(),
        ]);

        Vendor::insert([
            'user_id' => $user_info->id,
            'vendor_address' => $request->vendor_address,
            'created_at' => Carbon::now(),
        ]);
        Mail::to($request->vendor_email)->send(new VendorNotification($random_password));
        return redirect()->route('vendor.index')->with('success', 'Vendor Created Successfully');
    }

    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        unlink(base_path('public/uploads/vendor_photos/' . $vendor->vendor_photo));
        $vendor->delete();
        return back()->with('delete', 'Vendor Deleted Successfully');
    }
}
