<?php
namespace Modules\App\Repositories;

interface AppRepository {

	function create(array $attributes);

	function update($id,array $attributes);

	function delete($id);

	function getById($id);

	function getAll();

	function givePermission($id,array $attributes);

	function getPermissionByAppId($id);

	function removePermission($id,array $attributes);

	function getNotGrantedPermissions($app_id);



}
