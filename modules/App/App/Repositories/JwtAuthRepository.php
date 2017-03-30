<?php
namespace Modules\App\Repositories;

use Modules\App\Entities\App;
use Modules\App\Entities\AppPermission;
use Modules\Permission\Entities\Permission;
use Modules\Client\Entities\ClientPermission;

class JwtAuthRepository
{
	private $app;
	private $permission;
	private $appPermission;
  private $clientPermission;

	public function __construct(App $app,Permission $permission,AppPermission $appPermission,ClientPermission $clientPermission)
	{
		$this->app = $app;
		$this->permission = $permission;
		$this->appPermission = $appPermission;
    $this->clientPermission = $clientPermission;
	}
	public function getAll(){
		return $this->app->all();
	}
  public function attempt(array $credentials){
		$app=$this->app->where('app_key','=',$credentials['app_key'])->where('app_secret','=',$credentials['app_secret'])->first();
		//return $app;
		if(count($app)>0){
      $token = $this->generateToken($app);
      return $token;
		}else{
			return false;
		}
	}
  private function generateToken($app){
    $appDate =array(
                  'identity'=>array(),
                  'payload'=>array('appinfo'=>array())
                );
    $appData['identity']['id']=$app['id'];
                                            // 7 days; 24 hours; 60 mins; 60 secs
    $appData['identity']['expired_at']=time() + (10 * 60);
    $appData['payload']['appinfo']['appName']=$app['name'];
    $appData['payload']['appinfo']['app_key']=$app['app_key'];
    $appData['payload']['appinfo']['app_secret']=$app['app_secret'];
    $token =  base64_encode(json_encode($appData));

    //$token = json_encode($token);
    return $token;
  }

  public function getAppByToken($token){
    $app = json_decode(base64_decode($token));
    if(count((array)$app)<=0){
      return 'Invalid token';
    }
    if($app->identity->expired_at<=time()){
      return 'token is expired';
    }
    //return $app->identity->id;
    return $this->app->findorfail($app->identity->id);
    //dd($app);
    //return json_decode(base64_decode($token));
  }
  public function checkApp($token){
    //return $token;
    $app = json_decode(base64_decode($token));
    //return $app;
    if(count((array)$app)<=0){
      return 'Invalid token';
    }
      if($app->identity->expired_at<=time()){
         return false;
      }
      return true;
  }
  public function checkAppPermission($token,$permission_id){
    //return $token;
    $app = json_decode(base64_decode($token));
    //return $app;
    if(count((array)$app)<=0){
      return 'Invalid token';
    }
    $app_id = $app->identity->id;
    $myApp =$this->appPermission
          ->where('app_id','=',$app_id)
          ->where('permission_id','=',$permission_id)
          ->get();
    if(count($myApp)<=0){
      return false;
    }
    return true;
  }

  public function checkClientPermission($client_id,$permission_id){    
    $myClient =$this->clientPermission
          ->where('client_id','=',$client_id)
          ->where('permission_id','=',$permission_id)
          ->get();
    if(count($myClient)<=0){
      return false;
    }
    return true;
  }

}
