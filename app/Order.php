<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function details()
	{
		return $this->hasMany('App\Detail');
	}

	public function item()
	{
		return $this->hasManyThrough('App\Detail', 'App\Item');
	}

	public function destination()
	{
		return $this->hasOne('App\Destination');
	}

}
