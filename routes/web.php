<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/items', 'ItemController');
Route::get('/inactiveItems', 'ItemController@inactive')->name('items.inactive');
Route::get('/restoreItem/{item}', 'ItemController@restore')->name('items.restore');
Route::get('/ofertas', 'ItemController@ofertas')->name('ofertas');

Route::get('/cart/{item}', 'CartController@add')->name('cart.add');
Route::get('/cart/{rowID}/remove', 'CartController@remove')->name('cart.remove');
Route::get('/cart/{rowID}/{qty}/minus', 'CartController@minus')->name('cart.minus');
Route::get('/cart/{rowID}/{qty}/plus', 'CartController@plus')->name('cart.plus');
Route::get('/empty', 'CartController@empty')->name('cart.empty');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');

Route::resource('/orders', 'OrderController');
Route::get('/pending', 'OrderController@pending')->name('order.pending');
Route::get('/sent', 'OrderController@sent')->name('order.sent');
Route::get('/send/{order}', 'OrderController@send')->name('order.send');
Route::get('/sales', 'OrderController@sales')->name('order.sales');

Route::get('/prueba', function(Request $request){

	$query = $flights = App\Item::withTrashed()->get();

	echo '<pre>';
	print_r($query);
	echo '</pre>';

	foreach ($query as $row) {
		echo '<pre>';
		//print_r($row);
		echo '</pre>';
	}

	
});