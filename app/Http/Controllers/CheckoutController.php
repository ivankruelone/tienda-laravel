<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$ship = \App\Ship::where('user_id', Auth::user()->id)->first();
    	return view('cart', compact('ship', 'user'));
    }
}
