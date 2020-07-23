<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = ['id'];
    protected $timestrap = true;    
    public function order_details()
    {
    	return $this->belongsto('App\Models\OrderDetail');
    } 
    public function customers()
    {
    	return $this->belongsto('App\Models\Customer', 'customer_id');
    } 
}