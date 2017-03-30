<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Lang;
use Session;
use Validator;

class LoginController extends Controller
{
     protected $redirectTo = 'auth/home';

    public function login()
    {
        return view('auth::login2');
    }

    public function username()
    {
        return 'email';
    }
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    { 
        $this->validate($request, [
            'email' => 'required', 'password' => 'required|min:6',
        ]);
        $input=$request->all();
        $email = $input['email'];
        $password = $input['password'];
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // Authentication passed...
            Session::flash('success','Wel Come to Our App');
            return redirect()->intended($this->redirectTo);
        }
        Session::flash('error','Sorry');
        return redirect()->intended('auth/login')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('auth/login');
    }
    

}