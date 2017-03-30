<?php
namespace Modules\App\Repositories;

use Modules\App\Entities\App;
use Modules\App\Entities\AppPermission;
use Modules\Permission\Entities\Permission;

use Session;
use Hash;
use DB;

/**
*
*/
class Eloquentapp implements appRepository
{
	private $app;
	private $permission;
	private $appPermission;

	public function __construct(App $app,Permission $permission,AppPermission $appPermission)
	{
		$this->app = $app;
		$this->permission = $permission;
		$this->appPermission = $appPermission;
	}
	public function getAll(){
		return $this->app->all();
	}

	public function create(array $attributes){
		$attributes['app_key']='app'.md5(microtime());
		$attributes['app_secret']='as'.md5(microtime());
		return $this->app->create($attributes);
	}
	public function update($id,array $attributes){
		return $this->app->findorfail($id)->update($attributes);
	}

	public function delete($id){
		return $this->app->findorfail($id)->delete();
	}

	public function getById($id){
		return $this->app->findorfail($id);
	}
	private function checkAlready($app_id,$permission_id){
		$permission = $this->appPermission->where('app_id',$app_id)->where('permission_id',$permission_id)->get();
		if(count($permission)>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function givePermission($id,array $attributes){
			foreach($attributes['check_list'] as $check) {
				if(!$this->checkAlready($id,$check)){
					$input['app_id'] = $id;
		        	$input['permission_id'] = $check;
		        	$this->appPermission->create($input);
				}
	        }
        return true;
	}

	public function getPermissionByAppId($id){
		$permissions = DB::table('permissions')
						->join('app_permissions','app_permissions.permission_id','=','permissions.id')
						->where('app_permissions.app_id','=',$id)
						->select('app_permissions.id','permissions.name')
						->get();

		return $permissions;
	}

	public function removePermission($id,array $attributes){

		foreach($attributes['check_list1'] as $check) {
			$this->appPermission->where('id',$check)->delete();
		}
		return true;
	}


	function getNotGrantedPermissions($app_id){
		//return $app_id;
		$permissions_already = $this->appPermission->where('app_id',$app_id)->select('permission_id')->get();
		//return $permissions_already;
		$permission_id =array();
		foreach($permissions_already as $pa){
			array_push($permission_id, $pa['permission_id']);
		}

		$permission = $this->permission->whereNotIn('id', $permission_id)->get();
		/*$permissions = DB::table('permissions')
						->join('app_permissions','app_permissions.permission_id','=','permissions.id')
						->where('app_permissions.app_id','!=',$app_id)
						->select('permissions.id','permissions.name')
						->get();*/

		return $permission;
	}
	


}
