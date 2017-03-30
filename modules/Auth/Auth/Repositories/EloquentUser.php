<?php
namespace Modules\Auth\Repositories;

use Modules\Auth\Entities\User;
use Modules\Auth\Entities\Verification;
use Session;
use Hash;
use DB;

/**
* 
*/
class EloquentUser implements UserRepository
{
	private $user;

	public function __construct(User $user,Verification $verification)
	{
		$this->user = $user;
		$this->verification = $verification;
	}

	public function register(array $attributes){
		$userData = array();
		if (array_key_exists("client_id",$attributes)){
			$userData['client_id']=$attributes['client_id'];
		}
		$userData['name']=$attributes['name'];
		$userData['email']=$attributes['email'];
		$userData['password']=bcrypt($attributes['password']);
	   
		return $this->user->create($userData);
	}

	public function update($id,array $attributes){
		return $this->user->findorfail($id)->update($attributes);
	}

	public function changePassword($id,array $attributes){
		$data['password'] =bcrypt($attributes['password']);
		return $this->user->findorfail($id)->update($data);
	}

	public function getPasswordById($user_id){
		$user = DB::table('users')->where('id',$user_id)->first();
		//$user = $this->user->findorfail($user_id)->get();
		return $user['password'];
	}

	public function delete($id){
		return $this->user->findorfail($id)->delete();
	}

	public function getById($id){
		return $this->user->findorfail($id);
	}

	public function generateVerificationCode($user_id){
		//$data['verification_code'] = strtoupper(str_random(10));
		$data['verification_code']= md5(microtime());
		$data['user_id'] = $user_id;
		$data['status'] = 'unverified';
		$this->verification->create($data);
		return $data['verification_code'];
	}

	public function getUserIdByVerificationCode($verification_code){
		$user = $this->verification->where('verification_code',$verification_code)->first();
		return $user['user_id'];
	}

	public function verify($verification_code){
		$data['status']='verified';
		$verification_details=$this->verification
									->where('verification_code',$verification_code)
									->first()
									->update($data);
		return $verification_details['user_id'];
	}

	public function isEmailVerified($user_id){
		$user = $this->verification->where('user_id',$user_id)->where('status','unverified')->first();
		if(count($user)>0){
			return true;
		}else{
			return false;
		}
	}

	public function getVerificationCodeByUserId($user_id){
		$verification_details= $this->verification->where('user_id',$user_id)->first();
		return $verification_details['verification_code'];
	}
}
