<?php
namespace App\Repositories\RolePermission;

/**
 *
 */
interface RolePermissionRepository {

	public function getRoleById($id);

	public function getAllRole();

	public function createRole(array $attributes);

	public function updateRole($id, array $attributes);

	public function deleteRole($id);

	public function getPermissionById($id);

	public function getAllPermission();

	public function createPermission(array $attributes);

	public function updatePermission($id, array $attributes);

	public function deletePermission($id);

	public function assignPermission(array $attributes);
	
	public function checkRoleHasPermission($role_id,$permission_id);

}