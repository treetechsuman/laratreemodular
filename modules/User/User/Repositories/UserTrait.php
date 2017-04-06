<?php 
namespace Modules\User\Repositories;

use Modules\User\Entities\User;

trait UserTrait{
    public static function generateVerificationCode($user_id) {    
	    $varification_code =  base64_encode($user_id);
	    //dd($token);
	    return $varification_code;
	}
	public static function generateToken($id){
		$appData =array(
                  'id'=>$id,
                  'expired_at'=>time() + (10 * 60) // 7 days; 24 hours; 60 mins; 60 secs
                );
    	$token =  base64_encode(json_encode($appData));
		//$token = '55252124';
		return $token;
	}
	public static function decordToken($token){
		if($app->expired_at<=time()){
	      return 'token is expired';
	    }
		$data = json_decode(base64_decode($token));
		return $data;
	}
}