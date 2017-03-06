<?php
namespace App\Http\Controllers\RolePermission;
//namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RolePermission\RolePermissionRepository;


class RolePermissionController extends Controller
{
	private $rolePermissionRepo;

	public function __construct(
			RolePermissionRepository $rolePermissionRepo 
		)
	{
		$this->rolePermissionRepo = $rolePermissionRepo;
	}

    public function index(){
    	$roles = $this->rolePermissionRepo->getAllRole();
    	$permissions = $this->rolePermissionRepo->getAllPermission();
    	$rolePermissionRepo = $this->rolePermissionRepo;
    	return view('backend.rolepermission.index',compact(
    		'roles',
    		'permissions',
    		'rolePermissionRepo'
    		));
	}

    public function createRole(Request $request){
    	$this->rolePermissionRepo->createRole($request->all());
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }

    public function editRole($id){
    	$role = $this->rolePermissionRepo->getRoleById($id);
    	return view('backend.rolepermission.edit_role',compact(
    														'role'
    													  ));
    }

    public function updateRole($id,Request $request){
    	$this->rolePermissionRepo->updateRole($id,$request->all());
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }

    public function deleteRole($id){
    	$this->rolePermissionRepo->deleteRole($id);
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }

    public function assignPermission(Request $request){
    	$this->rolePermissionRepo->assignPermission($request->all());
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }

    public function createPermission(Request $request){
    	$this->rolePermissionRepo->createPermission($request->all());
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }

    public function editPermission($id){
    	$permission = $this->rolePermissionRepo->getPermissionById($id);
    	return view('backend.rolepermission.edit_permission',compact(
    														'permission'
    													  ));
    }

    public function updatePermission($id,Request $request){
    	$this->rolePermissionRepo->updatePermission($id,$request->all());
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }

    public function deletePermission($id){
    	$this->rolePermissionRepo->deletePermission($id);
    	session()->flash('success','');
    	return redirect('role-permission/role');
    }
    
    public function checkRoleHasPermission($role_id,$permission_id){
    	return $this->rolePermissionRepo->checkRoleHasPermission($role_id,$permission_id);
    }
}
