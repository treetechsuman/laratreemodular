<?php
namespace Modules\Auth\Repositories;

interface UserRepository {

	function register(array $attributes);

	function update($id,array $attributes);

	function delete($id);

	function getById($id);

	function generateVerificationCode($user_id);

	function getUserIdByVerificationCode($verification_code);

	function getVerificationCodeByUserId($user_id);

	function verify($verification_code);

	function isEmailVerified($user_id);

	function changePassword($id,array $attributes);

	function getPasswordById($user_id);
}