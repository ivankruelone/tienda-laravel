<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    protected $table = 'items';

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function gender()
    {
    	return $this->belongsTo('App\Gender');
    }
}
