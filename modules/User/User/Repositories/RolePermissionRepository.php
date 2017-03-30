<?php 
namespace Modules\User\Repositories;

interface RolePermissionRepository {

	function getAllPermission();

	function getPermissionById($id);

	function createPermission(array $attributes);

	function updatePermission($id, array $attributes);

	function deletePermission($id);

	function getAllRole();

	function getRoleById($id);

	function createRole(array $attributes);

	function updateRole($id, array $attributes);

	function deleteRole($id);

}
