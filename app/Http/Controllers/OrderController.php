<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = \App\Order::all()->sortByDesc('id');
        return view('orders/index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Cart::total() > 0)
        {
            $order = new \App\Order;
            $order->user_id = Auth::user()->id;
            $order->subtotal = Cart::subtotal();
            $order->tax = Cart::tax();
            $order->total = Cart::total();
            $order->save();

            foreach (Cart::content() as $cart) {
                
                $detail = new \App\Detail;
                $detail->order_id = $order->id;
                $detail->item_id = $cart->id;
                $detail->order_cost = $cart->options->cost;
                $detail->order_price = $cart->price;
                $detail->qty = $cart->qty;
                $detail->save();
            }

            Cart::destroy();

            $destination = new \App\Destination;
            $destination->order_id = $order->id;
            $destination->firstname = $request->firstname;
            $destination->lastname = $request->lastname;
            $destination->address1 = $request->address1;
            $destination->address2 = $request->address2;
            $destination->email = $request->email;
            $destination->country = $request->country;
            $destination->state = $request->state;
            $destination->zip = $request->zip;
            $destination->save();

            if($request->saveInfo == 'on')
            {
                $ship = \App\Ship::where('user_id', Auth::user()->id)->first();

                if($ship == null)
                {
                    $ship = new \App\Ship;
                }
                
                $ship->user_id = Auth::user()->id;
                $ship->firstname = $request->firstname;
                $ship->lastname = $request->lastname;
                $ship->address1 = $request->address1;
                $ship->address2 = $request->address2;
                $ship->email = $request->email;
                $ship->country = $request->country;
                $ship->state = $request->state;
                $ship->zip = $request->zip;
                $ship->save();
            }

        }


        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function pending()
    {
        $orders = \App\Order::where('status', 'PENDING')->orderBy('id')->get();
        return view('orders.pending', compact('orders'));
    }

    public function send(Order $order)
    {
        $order->status = 'SENT';
        $order->save();

        return redirect('/pending');
    }

    public function sent()
    {
        $orders = \App\Order::where('status', 'SENT')->orderBy('id')->get();
        return view('orders.sent', compact('orders'));
    }

    public function sales()
    {
        $sales = DB::table('orders')
        ->select(DB::raw('sum(subtotal) as subtotal, sum(tax) as tax, sum(total) as total'))
        ->get()->first();

        $todaySales = DB::table('orders')
        ->select(DB::raw('sum(subtotal) as subtotal, sum(tax) as tax, sum(total) as total'))
        ->whereRaw('date(created_at) = date(now())')
        ->get()->first();

        $lastWeekSales = DB::table('orders')
        ->select(DB::raw('sum(subtotal) as subtotal, sum(tax) as tax, sum(total) as total'))
        ->whereRaw('created_at between now() - interval 1 week and now()')
        ->get()->first();

        $lastMonthSales = DB::table('orders')
        ->select(DB::raw('sum(subtotal) as subtotal, sum(tax) as tax, sum(total) as total'))
        ->whereRaw('created_at between now() - interval 1 month and now()')
        ->get()->first();

        $lastYearSales = DB::table('orders')
        ->select(DB::raw('sum(subtotal) as subtotal, sum(tax) as tax, sum(total) as total'))
        ->whereRaw('created_at between now() - interval 1 year and now()')
        ->get()->first();

        return view('orders.sales', compact('sales', 'todaySales', 'lastWeekSales', 'lastMonthSales', 'lastYearSales'));
    }
}
