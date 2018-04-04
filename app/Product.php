<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function categories()
    {
      return $this->belongsTo('App\Category','category');
    }
    public function ProductImages()
    {
      return $this->hasMany('App\ProductImages', 'product_id','productID');
    }
}
