<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Contracts\SocialServiceInterface;

class AuthController extends Controller
{
    public function redirect()
    {
    	//dd(Socialite::driver('facebook'));
    	return Socialite::driver('facebook')->redirect(); 
    } 

    public function callback(SocialServiceInterface $socialService) 
    {
		$user = Socialite::driver('facebook')->user();
		$authUser = $socialService->createOrGetUser($user);
		
		if ($authUser) {
			Auth::login($authUser, true);
            return redirect('home');
		}
    }
}
