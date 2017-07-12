<?php

namespace App\Repositories\RolePermission;

use App\User;
use App\Model\Role;
use App\Model\Permission;
use App\Model\RolePermission;
use DB;

/**
 *
 */
class EloquentRolePermission implements RolePermissionRepository {
  private $role;
  private $permission;
  private $pivotRolePermission;

	public function __construct( 
     Role $role,
     Permission $permission,
     RolePermission $pivotRolePermission
  ) 
  {
    $this->role = $role;
    $this->permission = $permission;
    $this->pivotRolePermission = $pivotRolePermission;
  }

	public function getRoleById($id) {
		return $this->role->findorfail($id);
	}

	public function getAllRole() {
		return $this->role->all();
    
	}

  public function createRole(array $attributes){
    return $this->role->create($attributes);
  }

  public function updateRole($id,array $attributes){
    return $this->role->findorfail($id)->update($attributes);
  }

  public function deleteRole($id){
    return $this->role->findorfail($id)->delete();
  }

  public function getPermissionById($id) {
    return $this->permission->findorfail($id);
  }
  
  public function getAllPermission() {
    return $this->permission->all();
  }

  public function createPermission(array $attributes){
    return $this->permission->create($attributes);
  }

  public function updatePermission($id,array $attributes){
    return $this->permission->findorfail($id)->update($attributes);
  }

  public function deletePermission($id){
    return $this->permission->findorfail($id)->delete();
  }

  public function assignPermission(array $attributes){
    $this->pivotRolePermission->where('role_id',$attributes['role_id'])->delete();
    foreach($attributes['permission_id'] as $permission){
      $data['role_id']=$attributes['role_id'];
      $data['permission_id']=$permission;      
      $this->pivotRolePermission->create($data);     
    }
  }

  public function getPermissionByRoleId($role_id){
    $permissionByRole = DB::table('role_permissions')
               ->join('permissions','permissions.id','=','role_permissions.permission_id')
               ->where('role_permissions.role_id','=',$role_id)
               ->select(
                  'role_permissions.id',
                  'role_permissions.permission_id',
                  'role_permissions.role_id',
                  'permissions.name'
                )
               ->get();
    return $permissionByRole;
  }

  public function checkRoleHasPermission($role_id,$permission_id){
    $rolePermission = $this->pivotRolePermission->where('role_id',$role_id)
                              ->where('permission_id',$permission_id)
                              ->select('*')
                              ->get();
    if(count($rolePermission)>0){
      return true;
    }
    return false;
  }

}