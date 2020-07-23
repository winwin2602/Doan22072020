<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";
    protected $guarded = ['id'];
    protected $timestrap = true;   
    //1 brand - many products
    public function products()
    {
    	return $this->hasMany('App\Models\Product');
    } 
}