<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'details';

    public function item()
    {
    	return $this->belongsTo('App\Item');
    }
}
