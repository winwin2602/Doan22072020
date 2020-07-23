<?php
namespace App\Repositories\RoleUser;
use App\Repositories\EloquentRepository;

class RoleUserRepository extends EloquentRepository implements RoleUserInterface{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\RoleUser::class;
    }
    public function getAllRoleOfUser($user_id){
    	return $this->_model::where('user_id', $user_id)->pluck('role_id');
    }
    public function deleteRoleOfUser($user_id){
    	
    	return $this->_model::where('user_id', $user_id)->delete();
    }
}