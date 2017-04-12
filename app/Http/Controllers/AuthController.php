<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\SocialService;

class AuthController extends Controller
{
    public function redirect()
    {
    	//dd(Socialite::driver('facebook'));
    	return Socialite::driver('facebook')->redirect(); 
    } 

    public function callback(SocialService $service) 
    {
		$user = Socialite::driver('facebook')->user();
		$authUser = $service->createOrGetUser($user);
		
		if ($authUser) {
			Auth::login($authUser, true);
            return redirect('home');
		}
    }
}
