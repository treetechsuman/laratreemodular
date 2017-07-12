<?php 
namespace App\Repositories\User;

use App\User;

class EloquentUser implements UserRepository{
	private $user;

	public function __construct(User $user){
		$this->user = $user;
	}
	public function getAllUser(){
		return $this->user->all();
	}

	public function getUserById($id){
		return $this->user->findorfail($id);
	}

	public function createUser(array $attributes){
		$attributes['password']=bcrypt($attributes['password']);
		return $this->user->create($attributes);
	}

	public function updateUser($id,array $attributes){
		return $this->user->findorfail($id)->update($attributes);
	}

	public function deleteUser($id){
		return $this->user->findorfail($id)->delete();
	}

}