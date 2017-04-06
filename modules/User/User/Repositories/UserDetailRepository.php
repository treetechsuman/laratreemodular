<?php 
namespace Modules\User\Repositories;

interface UserDetailRepository {

	function getAllUserDetail();

	function getUserDetailById($id);

	function createUserDetail(array $attributes);

	function updateUserDetail($id, array $attributes);

	function deleteUserDetail($id);

}
