<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $guarded = ['id'];
    protected $timestrap = true;   
    public function permissions()
	{
	    return $this->belongstoMany('App\Models\Permission', 'permission_roles');
	} 
	public function uses()
	{
	    return $this->belongstoMany('App\Models\User', 'role_user');
	} 
}