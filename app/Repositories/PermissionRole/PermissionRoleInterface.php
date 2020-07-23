<?php
namespace App\Repositories\PermissionRole;

interface PermissionRoleInterface
{
	public function getAllPermissionOfRole($role_id);
	public function deletePermissionOfRole($role_id);
}