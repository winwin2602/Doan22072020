<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = ['id'];
    protected $timestrap = true;    
    public function brands()
    {
    	return $this->belongsto('App\Models\Brand');
    }
    public function categories()
    {
    	return $this->belongsto('App\Models\ProductCategory');
    }
    // 1 product - has many order  detail
    public function order_details()
    {
    	return $this->hasMany('App\Models\OrderDetail');
    } 
}