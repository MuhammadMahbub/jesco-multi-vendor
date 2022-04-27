<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function contactmessage(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        Contact::insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'message'    => $request->message,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('index');
    }
}
