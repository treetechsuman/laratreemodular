<?php

namespace Modules\Auth\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use Modules\Auth\Repositories\UserRepository;
use Modules\Auth\Emails\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Session;
class RegisterController extends Controller
{
   
    private $userRepo;

    protected $redirectTo = 'auth/home';

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    //load register view---------------
    public function create()
    {
        return view('auth::register2');
    }

    //register new user to our app--------
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
       
        $new_user = $this->userRepo->register($request->all());
        if($new_user){           
            //create verification link -----------------
            $verification_code = $this->userRepo->generateVerificationCode($new_user['id']);
            //send verification mail------------------
            Mail::to($request['email'])->send(new VerificationEmail($verification_code));
            Auth::loginUsingId($new_user['id'], true);
            Session::flash('success','Wel Come to Our App');
            //send sms notification--------------------------
            //Notification::send($users, new InvoicePaid($invoice));
            return redirect($this->redirectTo);
        }
        Session::flash('error','Sorry Some Error occure');
    }

    public function verify($verification_code)
    {
       $user_id= $this->userRepo->verify($verification_code);
       Auth::loginUsingId($user_id, true);
       Session::flash('success','Email Varification is sended Check your mail');
       return redirect($this->redirectTo);
    }
}
