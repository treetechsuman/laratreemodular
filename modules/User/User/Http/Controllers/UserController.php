<?php 

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\User\Repositories\UserRepository;
use Modules\User\Repositories\UserDetailRepository;
use Modules\User\Repositories\RolePermissionRepository;
use Modules\User\Events\UserCreated;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Session;



class UserController extends Controller{
	private $userRepo;
	private $userDetailRepo;
	private $rolePermissionRepo;

	public function __construct(
								UserRepository $userRepo,
								UserDetailRepository $userDetailRepo,
								RolePermissionRepository $rolePermissionRepo
	){
		$this->userRepo = $userRepo;
		$this->userDetailRepo = $userDetailRepo;
		$this->rolePermissionRepo = $rolePermissionRepo;
	}

	public function index(){
		$users = $this->userRepo->getAllUser();
		$userRepo = $this->userRepo;
		return view('user::user.index',compact('users','userRepo'));
	}

	public function create(){
		return view('user::user.create');
	}

	public function store(Request $request){
		$user = $this->userRepo->createUser($request->all());
		event(new UserCreated($user));
		return redirect('admin/user/user');
	}

	public function show(){
		return view('user::user.show');
	}

	public function edit($id){
		$myuser = $this->userRepo->getUserById($id);
		return view('user::user.edit',compact('myuser'));
	}

	public function update($id ,Request $request){
		$this->userRepo->updateUser($id,$request->all());
		return redirect('admin/user/user');
	}

	public function delete($id){
		$this->userRepo->deleteUser($id);
		return redirect('admin/user/user');
	}

	public function assignRole($user_id){
		$roles = $this->rolePermissionRepo->getAllRole();
		$myuser = $user_id;
		$userRepo =$this->userRepo;
    	return view('user::user.assign-role',compact('roles','myuser','userRepo'));
    }

	public function storeAssignRole(Request $request){
		//return $request->all();
    	$this->userRepo->assignRole($request->all());
    	session()->flash('success','Operation Success');
    	return back();
    }

    public function manageUser($user_id){
    	$myuser = $user_id;
    	$roles = $this->rolePermissionRepo->getAllRole();
    	$userRepo =$this->userRepo;
    	$userDetail = $this->userDetailRepo->getUserDetailByUserId($user_id);
    	return view('user::user.manage-user',compact('roles','userDetail','myuser','userRepo'));
    }

    public function changePassword(Request $request){
    	//dd($request->all());
    	$this->userRepo->changePassword($request->all());
    	Session::flash('success','Password Changed for this user');
		return back();
    }

    public function emailTemplete($templete_name=''){
    	if($templete_name == ''){
    		$templete_name = 'welcome';
    	}
    	$myuser=array();
    	$activation_code = 'dummyCode';
    	$myuser['name'] = 'dummy name';
    	return view('user::email.email-templete-list',compact('templete_name','myuser','activation_code'));
    }

    public function activateUser(Request $request){
    	//return $request->all();
    	$user_id = base64_decode($request['activation_code']);
    	$data['status']='Active';
    	$data['user_id']=$user_id;
    	try{
	    	$this->userDetailRepo->getUserDetailById($user_id);
    	}catch(Exception $e){
	    	//if ($e instanceof NotFoundHttpException)
			{
			    $this->userDetailRepo->createUserDetail($data);
			    //dd($data);
			}
		}	
    	return 'account is acitvated redirect where you like';
    }

    public function socialLogin(){
    	return view('user::user.social-login');
    }

}