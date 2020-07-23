<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = "permission_roles";
    protected $guarded = ['id'];
    protected $timestrap = true;    
}