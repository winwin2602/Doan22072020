<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use DB;
use Auth;
class CheckPermissionAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $roleAdmin = User::find(auth()->guard('admin')->id())->roles()->select('roles.name')->pluck('name')->toArray(); 
        $listRoleOfUser = User::find(auth()->guard('admin')->id())->roles()->select('roles.id')->pluck('id')->toArray();
        $listRoleOfUser = DB::table('roles')
            ->join('permission_roles', 'roles.id', '=', 'permission_roles.role_id')
            ->join('permissions', 'permission_roles.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id', $listRoleOfUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();
        $checkPermission = Permission::where('name', $permission)->value('id');
        if ( $listRoleOfUser->contains($checkPermission)) return $next($request);        
        return abort(401);
    }
}
