<?php
namespace App\Repositories\RoleUser;

interface RoleUserInterface
{
	public function getAllRoleOfUser($user_id);
	public function deleteRoleOfUser($user_id);
}