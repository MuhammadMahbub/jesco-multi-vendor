<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        return view('profile');
    }
    function name_change(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request->name;
        User::find(Auth::id())->update([
            'name' => $name,
        ]);
        return redirect()->to('/home')->with('success', 'name changed');;
    }
    function change_password(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'new_password' => 'min:8'
        ]);

        $hashcheck = Hash::check($request->old_password, Auth::user()->password);
        if ($hashcheck) {
            if ($request->new_password == $request->confirm_password) {
                User::find(Auth::id())->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return redirect()->to('/home')->with('success', 'password changed');
            } else {
                return back()->withErrors('password match kore nai');
            }
        } else {
            return back()->withErrors('old password match kore nai');
        }
    }

    function profile_photo_change(Request $request)
    {
        $request->validate([
            'new_profile_photo' => 'required | image',
        ]);

        if (Auth::user()->profile_photo !== 'default.jpg') {
            $old_link = base_path('public/uploads/profile_photos/' . Auth::user()->profile_photo);
            unlink($old_link);
        }
        $ext = $request->file('new_profile_photo')->getClientOriginalExtension();
        $new_name = Auth::id() . '-' . uniqid() . '.' . $ext;
        Image::make($request->file('new_profile_photo'))->resize(300, 300)->save(base_path('public/uploads/profile_photos/' . $new_name));

        User::find(Auth::id())->update([
            'profile_photo' => $new_name,
        ]);
        return back()->with('success', "photo uploaded");
    }
}
