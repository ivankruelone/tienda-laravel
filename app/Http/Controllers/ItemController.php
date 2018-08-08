<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = \App\Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all();
        $genders = \App\Gender::all();
        return view('items.create', compact('categories', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $image = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $image);
        }
        $item = new \App\Item;
        $item->sku = $request->get('sku');
        $item->gender_id = $request->get('gender_id');
        $item->category_id = $request->get('category_id');
        $item->description = $request->get('description');
        $item->slug = $request->get('slug');
        $item->cost = $request->get('cost');
        $item->price = $request->get('price');
        $item->image = $image;
        $item->save();

        return redirect('items')->with('success', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = \App\Category::all();
        $genders = \App\Gender::all();
        return view('items.edit', compact('categories', 'genders', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $image = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $image);
        }

        $item->sku = $request->get('sku');
        $item->gender_id = $request->get('gender_id');
        $item->category_id = $request->get('category_id');
        $item->description = $request->get('description');
        $item->slug = $request->get('slug');
        $item->cost = $request->get('cost');
        $item->price = $request->get('price');
        if($request->hasfile('image'))
        {
            $item->image = $image;
        }
        $item->save();

        return redirect('/items')->with('success', 'Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('/items')->with('success', 'Information has been deleted');
    }

    public function ofertas()
    {

    }

    public function inactive()
    {
        $items = \App\Item::onlyTrashed()->get();
        return view('items.inactive', compact('items'));
    }

    public function restore($id)
    {
        $item = \App\Item::onlyTrashed()
                ->find($id)
                ->restore();
        return redirect('/inactiveItems')->with('success', 'Information has been deleted');
    }
}
