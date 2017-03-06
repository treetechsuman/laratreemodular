<?php 
namespace App\Repositories\User;

interface UserRepository {

	function getAllUser();

	function getUserById($id);

	function createUser(array $attributes);

	function updateUser($id, array $attributes);

	function deleteUser($id);

}
