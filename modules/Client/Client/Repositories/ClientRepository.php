<?php
namespace Modules\Client\Repositories;

interface ClientRepository {

	function getAll();

	function getById($id);

	function create(array $attributes);

	function update($id,array $attributes);

	function delete($id);

	function authMe(array $attributes);

	function getClient(array $attributes);

	function givePermission($id,array $attributes);

	function getPermissionByCLientId($id);

	function removePermission($id,array $attributes);

	function getNotGrantedPermissions($app_id);

	function getClientBySlag($slag);
}