<?php 

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Modules\User\Repositories\UserDetailRepository;


class UserDetailController extends Controller{
	private $userDetailRepo;

	public function __construct(
		UserDetailRepository $userDetailRepo
	){
		$this->userDetailRepo = $userDetailRepo;
	}

	public function store(Request $request){
		$this->userDetailRepo->createUserDetail($request->all());
		Session::flash('success','Operation Success');
		return back();
	}

	public function update($id ,Request $request){
		$this->userDetailRepo->updateUserDetail($id,$request->all());
		Session::flash('success','Operation Success');
		return back();
	}

	public function delete($id){
		$this->userDetailRepo->deleteUserDetail($id);
		Session::flash('success','Operation Success');
		return back();
	}

}