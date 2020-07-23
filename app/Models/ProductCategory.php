<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "product_categories";
    protected $guarded = ['id'];
    protected $timestrap = true; 
    // 1 product category - has many products   
    public function products()
    {
    	return $this->hasMany('App\Models\Product');
    } 
}