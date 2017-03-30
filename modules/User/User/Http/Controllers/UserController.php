<?php 

namespace Modules\User\Http\Controllers;
use Modules\User\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\User\Repositories\UserRepository;
use Modules\User\Repositories\RolePermissionRepository;



class UserController extends Controller{
	
	private $user;
	private $userRepo;
	private $rolePermissionRepo;

	public function __construct(
								User $user,
								UserRepository $userRepo,
								RolePermissionRepository $rolePermissionRepo
	){
		$this->user=$user;
		$this->userRepo = $userRepo;
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

		 $input = $request->all();
        if ($input) {
            $destinationPath = 'uploads/users';
            if ($image = Input::file('userimage_name')) {
                $input['userimage_name'] = str_random(6) . '_' . time() . "-" . $request->file('userimage_name')
                        ->getClientOriginalName();
                $request->file('userimage_name')->move($destinationPath, $input['userimage_name']);
            }

            $input['password']=bcrypt($input['password']);
            //  $password = Hash::make(Input::get('password'));
            $ip = $request->getClientIp();

            $input['ip_address'] = $ip;
            $browserAgent = $_SERVER['HTTP_USER_AGENT'];
            $input['browser_agent'] = $browserAgent;

            User::create($input);
            session()->flash('success', 'Well Done! Record added successfully.');
            return redirect('admin/user/user');

        } else {
            session()->flash('error', 'Sorry! Could not proceed the Request.');
            return redirect()
                ->back();

        }
    




		// $this->userRepo->createUser($request->all());
		// return redirect('admin/user/user');
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
    	return redirect('admin/user/user');
    }

}