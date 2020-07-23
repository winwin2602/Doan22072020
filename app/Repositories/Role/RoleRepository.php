<?php
namespace App\Repositories\Role;
use App\Repositories\EloquentRepository;

class RoleRepository extends EloquentRepository implements RoleInterface{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Role::class;
    }
}