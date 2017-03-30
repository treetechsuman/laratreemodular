<?php

namespace Modules\Auth\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Auth\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Emails\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Session;

class AuthController extends Controller
{

    private $userRepo;

    //protected $redirectTo = 'auth/home';

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $userRepo = $this->userRepo;
        return view('auth::index',compact('userRepo'));
    }

    public function home()
    {
        $userRepo = $this->userRepo;
        //Session::flash('error', 'You are not Home');
        return view('auth::home',compact('userRepo'));
    }

    public function profile(){
        $userRepo = $this->userRepo;
        return view('auth::profile',compact('userRepo'));
    }

    public function setting(){
        $userRepo = $this->userRepo;
        return view('auth::setting',compact('userRepo'));
    }

    public function update(Request $request){
       if($this->userRepo->update(Auth::id(),$request->all())){
            Session::flash('success', 'Name is Updated');
            return redirect('auth/setting');
       }
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);
        $inputs = $request->all();
        $hash = $this->userRepo->getPasswordById(Auth::id());
        if (password_verify($inputs['current_password'], $hash)) {
            $this->userRepo->changePassword(Auth::id(),$inputs);
            Session::flash('success', 'Your password is changed');
        } else {
            Session::flash('error', 'Sorry Unable to change Password');
        }
        return redirect('auth/setting');
    }

    public function sendVerification()
    {
        return view('auth::sendverification');
    }

    public function sendVerificationEmail(Request $request){
        
        //get verification code -----------------
        $verification_code = $this->userRepo->getVerificationCodeByUserId(Auth::id());
         //send verification mail------------------
        Mail::to($request['email'])->send(new VerificationEmail($verification_code));
        Session::flash('success', 'Email is Sended');
        return redirect('auth/home');
    }

    public function unauthorized()
    {
        return view('auth::unauthorized');
    }


    
}
