<?php
namespace App\Repositories\Permission;
use App\Repositories\EloquentRepository;

class PermissionRepository extends EloquentRepository implements PermissionInterface{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Permission::class;
    }
}