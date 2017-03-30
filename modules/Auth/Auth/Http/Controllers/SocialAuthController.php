<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
//use Laravel\Socialite\Facades\Socialite;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\SocialProvider;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    private $user;
    private $socialProvider;


    public function __construct(User $user, SocialProvider $socialProvider){
        $this->user = $user;
        $this->socialProvider =$socialProvider;
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectTo($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleCallback($provider,Request $request)
    {
        try
        {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        }
        catch(\Exception $e)
        {
            return redirect('/auth/login');
        }
        //check if we have logged provider
        $socialProvider = $this->socialProvider->where('provider_id',$socialUser->getId())->first();
        if(!$socialProvider)
        {
            //create a new user and provider
            $user = $this->user->firstOrCreate(
                ['email' => $socialUser->getEmail()],
                ['name' => $socialUser->getName()],
                ['client_id'=>0]
            );
            $this->socialProvider->create(
                ['user_id'=>$user->id,'provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
            //login with new user id---------------
            Auth::loginUsingId($user['id'], true);
            return redirect('auth/home');
           
        }
        else{
            //login with old user id---------------
            Auth::loginUsingId($socialProvider['user_id'], true);
            return redirect('auth/home');
            
        }
    }
  
}