<?php
namespace App\Repositories\PermissionRole;
use App\Repositories\EloquentRepository;

class PermissionRoleRepository extends EloquentRepository implements PermissionRoleInterface{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\PermissionRole::class;
    }
    public function getAllPermissionOfRole($role_id){
    	return $this->_model::where('role_id', $role_id)->pluck('permission_id');
    }
    public function deletePermissionOfRole($role_id){

    	return $this->_model::where('role_id', $role_id)->delete();
    }
}