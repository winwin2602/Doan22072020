<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $guarded = ['id'];
    protected $timestrap = true;  
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'permission_roles');
    }  
}