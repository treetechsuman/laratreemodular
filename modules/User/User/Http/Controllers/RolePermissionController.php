<?php 

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\RolePermissionRepository;


class RolePermissionController extends Controller{
	private $rolePermissionRepo;

	public function __construct(
		RolePermissionRepository $rolePermissionRepo
	){
		$this->rolePermissionRepo = $rolePermissionRepo;
	}

	public function index(){
		$roles = $this->rolePermissionRepo->getAllRole();
		$permissions = $this->rolePermissionRepo->getAllPermission();
		$rolePermissionRepo = $this->rolePermissionRepo;
		return view('user::rolePermission.index',compact('roles','permissions','rolePermissionRepo'));
	}

	public function create(){
		return view('user::rolePermission.create');
	}

	public function store(Request $request){
		$this->rolePermissionRepo->createRole($request->all());
		return redirect('admin/user/role-permission');
	}

	public function show(){
		return view('user::role-permission.show');
	}

	public function edit($id){
		$role = $this->rolePermissionRepo->getRoleById($id);
		return view('user::rolePermission.edit',compact('role'));
	}

	public function update($id ,Request $request){
		$this->rolePermissionRepo->updateRole($id,$request->all());
		return redirect('admin/user/role-permission');
	}

	public function delete($id){
		$this->rolePermissionRepo->deleteRole($id);
		return redirect('admin/user/role-permission');
	}

	public function createPermission(){
		return view('user::rolePermission.create');
	}

	public function storePermission(Request $request){
		$this->rolePermissionRepo->createPermission($request->all());
		return redirect('admin/user/role-permission');
	}

	public function showPermission(){
		return view('user::role-permission.show');
	}

	public function editPermission($id){
		$permission = $this->rolePermissionRepo->getPermissionById($id);
		return view('user::rolePermission.edit-permission',compact('permission'));
	}

	public function updatePermission($id ,Request $request){
		$this->rolePermissionRepo->updatePermission($id,$request->all());
		return redirect('admin/user/role-permission');
	}

	public function deletePermission($id){
		$this->rolePermissionRepo->deletePermission($id);
		return redirect('admin/user/role-permission');
	}

	public function assignPermission(Request $request){
    	$this->rolePermissionRepo->assignPermission($request->all());
    	session()->flash('success','Operation Success');
    	return redirect('admin/user/role-permission');
    }

    public function checkRoleHasPermission($role_id,$permission_id){
    	return $this->rolePermissionRepo->checkRoleHasPermission($role_id,$permission_id);
    }
}