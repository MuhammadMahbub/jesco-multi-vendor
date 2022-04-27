<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponForm;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('coupon.create');
    }

    public function store(CouponForm $request)
    {
        // Validate using CouponForm
        Coupon::insert($request->except('_token') + [
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
