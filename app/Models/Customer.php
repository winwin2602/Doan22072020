<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $guarded = ['id'];
    protected $timestrap = true;  
    // 1 customer - has many orders  
    public function orders()
    {
    	return $this->hasMany('App\Models\Order');
    }
    public function users()
    {
        return $this->hasOne('App\Models\User','user_id');
    }
}