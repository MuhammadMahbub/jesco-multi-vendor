<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmailOffer;
use Illuminate\Support\Facades\Mail;
use App\Models\Country;
use App\Models\Order_detail;
use App\Models\Order_summery;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Order_summeriesExport;
use App\Models\Cart;
use App\Models\Rating;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (strpos(url()->previous(), 'product/details')) {
            return redirect(url()->previous());
        }
        $total_users     = User::count();
        $total_customers = User::where('role', 1)->count();
        $total_admins    = User::where('role', 2)->count();
        $total_vendors   = User::where('role', 3)->count();

        return view('home', compact('total_users', 'total_admins', 'total_customers', 'total_vendors'));
    }

    public function email_offer()
    {
        $customers = User::where('role', 1)->get();
        return view('offer.email_offer', compact('customers'));
    }

    public function single_email_offer($id)
    {
        $email = User::find($id)->email;
        Mail::to($email)->send(new EmailOffer());
        return back();
    }

    public function multi_email_offer(Request $request)
    {
        foreach ($request->check as $id) {
            Mail::to(User::find($id)->email)->send(new EmailOffer());
        }
        return back();
    }

    public function location()
    {
        return view('location.location', [
            'countries' => Country::get(['id', 'name', 'status']),
        ]);
    }

    public function locationupdate(Request $request)
    {
        Country::where('status', 'active')->update([
            'status' => 'deactive'
        ]);
        foreach ($request->countries as $country_id) {
            Country::find($country_id)->update([
                'status' => 'active'
            ]);
        }
        return back();
    }

    // admin site
    public function allorders(Request $request)
    {
        return view('all_orders.index', [
            'order_summeries' => Order_summery::all(),
        ]);
    }

    public function markreceived($order_summery_id)
    {
        // return $order_summery_id;
        Order_summery::find($order_summery_id)->update([
            'delivered_status' => '1',
        ]);
        return back();
    }

    public function my_order(Request $request)
    {
        return view('my_order.index', [
            'order_summeries' => Order_summery::where('user_id', auth()->id())->get()
        ]);
    }

    public function my_order_details($order_summery_id)
    {
        return view('my_order.order_details', [
            'order_summeries' => Order_summery::find(Crypt::decryptString($order_summery_id)),
            'order_details'   => Order_detail::where('order_summery_id', Crypt::decryptString($order_summery_id))->get(),
        ]);
    }

    public function reviewrating(Request $request, $order_detail_id)
    {
        Rating::insert([
            'user_id'          => auth()->id(),
            'product_id'       => Order_detail::find($order_detail_id)->product_id,
            'order_details_id' => $order_detail_id,
            'rating'           => $request->rate,
            'review'           => $request->review,
        ]);
        return back();
    }

    // Invoice Download
    public function invoicedownload(Request $request)
    {
        $pdf = PDF::loadView('pdf.invoice');
        return $pdf->stream('invoice.pdf');
    }

    public function invoicedownloadexcel(Request $request)
    {
        return Excel::download(new Order_summeriesExport, 'users.xlsx');
    }
}
