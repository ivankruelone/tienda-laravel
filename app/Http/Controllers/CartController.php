<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add(Item $item)
    {
    	Cart::add(['id' => $item->id, 'sku' => $item->sku, 'name' => $item->description, 'qty' => 1, 'price' => $item->price, 'options' => ['image' => $item->image, 'cost' => $item->cost]]);
    	return redirect('/');
    }

    public function remove($rowId)
    {
    	Cart::remove($rowId);
    	return redirect('/checkout');
    }

    public function minus($rowId, $qty)
    {
    	$qty--;
    	Cart::update($rowId, $qty);
    	return redirect('/checkout');
    }

    public function plus($rowId, $qty)
    {
    	$qty++;
    	Cart::update($rowId, $qty);
    	return redirect('/checkout');
    }

    public function empty()
    {
    	Cart::destroy();
    	return redirect('/');
    }

}
