<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    function index()
    {
    	$items = \App\Item::all();
    	return view('landing', compact('items'));
    }
}
