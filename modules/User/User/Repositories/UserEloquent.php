<?php 
namespace Modules\User\Repositories;

use Modules\User\Entities\User;
use Modules\User\Entities\UserRole;
use Modules\User\Entities\UserDetail;
use Modules\User\Repositories\UserDetailEloquent;
use DB;

class UserEloquent implements UserRepository{
	private $user;
	private $userRole;
	private $userDetail;
	private $userDetailRepo;

	public function __construct(User $user,
		UserRole $userRole,UserDetail $userDetail,UserDetailEloquent $userDetailRepo)
	{
		$this->user = $user;
		$this->userRole = $userRole;
		$this->userDetail = $userDetail;
		$this->userDetailRepo = $userDetailRepo;
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
		//delete image of this user if exist
		$userDetail = $this->userDetail->where('user_id',$id)->first();
		if($userDetail){
			$this->userDetailRepo->deleteUserDetail($userDetail['id']);
		}
		return $this->user->findorfail($id)->delete();
	}

	//===========================user role===========================
	
	public function createUserRole(array $attributes){
		return $this->userRole->create($attributes);
	}

	public function updateUserRole($id,array $attributes){
		return $this->userRole->findorfail($id)->update($attributes);
	}

	public function deleteUserRole($id){
		return $this->userRole->findorfail($id)->delete();
	}

	public function assignRole(array $attributes){
	    $this->userRole->where('user_id',$attributes['user_id'])->delete();
	    if (array_key_exists("role_id",$attributes)){
		    foreach($attributes['role_id'] as $role){
		      $data['user_id']=$attributes['user_id'];
		      $data['role_id']=$role;      
		      $this->userRole->create($data);     
		    }
		}
  	}
	public function getRoleByUserId($user_id){
	    $roleByUser = DB::table('user_roles')
	               ->join('roles','roles.id','=','user_roles.role_id')
	               ->where('user_roles.user_id','=',$user_id)
	               ->select(
	                  'user_roles.id',
	                  'user_roles.role_id',
	                  'user_roles.user_id',
	                  'roles.name'
	                )
	               ->get();
	    return $roleByUser;
   }

	public function checkUserHasRole($user_id,$role_id){
	    $userRole = $this->userRole->where('role_id',$role_id)
	                              ->where('user_id',$user_id)
	                              ->select('*')
	                              ->get();
	    if(count($userRole)>0){
	      return true;
	    }
	    return false;
    }

    public function changePassword(array $attributes){
    	$attributes['password']=bcrypt($attributes['password']);
    	$this->user->findorfail($attributes['user_id'])->update($attributes);
    }

}