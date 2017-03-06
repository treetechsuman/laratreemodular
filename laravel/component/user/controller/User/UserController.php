<?php 

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;


class UserController extends Controller{
	private $userRepo;

	public function __construct(
		UserRepository $userRepo
	){
		$this->userRepo = $userRepo;
	}

	public function index(){
		$users = $this->userRepo->getAllUser();
		return view('backend.user.index',compact('users'));
	}

	public function create(){
		return view('backend.user.create');
	}

	public function store(Request $request){
		$this->userRepo->createUser($request->all());
		return redirect('admin/user');
	}

	public function show(){
		return view('backend.user.show');
	}

	public function edit($id){
		$user = $this->userRepo->getUserById($id);
		return view('backend.user.edit',compact('user'));
	}

	public function update($id ,Request $request){
		$this->userRepo->updateUser($id,$request->all());
		return redirect('admin/user');
	}

	public function delete($id){
		$this->userRepo->deleteUser($id);
		return redirect('admin/user');
	}

	public function profile($id){
		//$user = $this->userRepo->getUserById($id);
		return view('backend.user.profile');
	}

}