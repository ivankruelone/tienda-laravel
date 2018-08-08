<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
