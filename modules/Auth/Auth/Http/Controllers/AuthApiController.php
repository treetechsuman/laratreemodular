<?php

namespace Modules\Auth\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use Modules\Auth\Repositories\UserRepository;
use Modules\Auth\Entities\SocialProvider;
use Modules\Auth\Entities\User;
use Modules\Auth\Emails\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Session;
class AuthApiController extends Controller
{
   
    private $userRepo;
    private $socialProvider;
    private $user;

    public function __construct(User $user,UserRepository $userRepo,SocialProvider $socialProvider)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
        $this->socialProvider =$socialProvider;

    }
    //this register function work for both registration of new user and login
    //for thouse user who register from social media
    //register new user to our app--------
    public function register(Request $request)
    {
        //return 'this is dashboard ';
        //return $request['client_id'];
        //check if we have logged provider
        $socialProvider = $this->socialProvider->where('provider_id',$request['id'])->first();
        if(!$socialProvider)
        {
            //create a new user and provider
            $user = $this->user->create($request->all());
            /*$user = $this->user->firstOrCreate(
                ['email' => $request['email']],
                ['name' => $request['name']],
                ['client_id'=> $request['client_id']],
                ['user_type'=>'admin']
            );*/
            $this->socialProvider->create(
                ['user_id'=>$user->id,'provider_id' => $request['id'], 'provider' => $request['provider']]
            );
            $response = [
                'message'=>'new user register suman',
                'user' => $user
            ];
            return response()->json($response,201);           
        }
        else{
            
            $user = $this->user->where('id','=',$socialProvider['user_id'])->first();
            $response = [
                'message' => 'user is already in system',
                'user'=>$user
            ];
            return response()->json($response,200);           
        }
    }

    public function verify($verification_code)
    {
       $user_id= $this->userRepo->verify($verification_code);
       Auth::loginUsingId($user_id, true);
       Session::flash('success','Email Varification is sended Check your mail');
       return redirect($this->redirectTo);
    }


    //this function ourRegister is for those user who register from our system
    public function ourRegister(Request $request){
       //return response()->json($request->all(),201);
        $new_user = $this->userRepo->register($request->all());
        if($new_user){           
            //create verification link -----------------
            $verification_code = $this->userRepo->generateVerificationCode($new_user['id']);
            //send verification mail------------------
            Mail::to($request['email'])->send(new VerificationEmail($verification_code));
            //Session::flash('success','Wel Come to Our App');
            //send sms notification--------------------------
            //Notification::send($users, new InvoicePaid($invoice));
            $response = [
                'message'=>'new user register',
                'user' => $new_user
            ];
            return response()->json($response,201);
        }
        $response = [
            'error'=>'error occure',
        ];
        return response()->json($response,404);
    }

    //this function ourRegister is for those user who register from our system
    public function ourLogin(Request $request){
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // Authentication passed...
           $response = [
                'message'=>'authentication pass',
                'user' => Auth::user()
            ];
            return response()->json($response,201);
        }
        
        $response = [
            'error'=>'error occure user not found',
        ];
        return response()->json($response,404);
    }
}
