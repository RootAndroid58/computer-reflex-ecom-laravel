<?php

namespace App\Http\Controllers;

use App\Models\User;
use Socialite;
use Auth;


use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function redirect($provider)
    {
     return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider)
    {
        $userSocial =   Socialite::driver($provider)->user();
        $users      =   User::where(['email' => $userSocial->getEmail()])->first();
        
        if($users){
            Auth::login($users);
            return redirect('/');
        }else{

            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'dp'            => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
                'status'        => 'active',
                'email_verified_at'      => date('y-m-d h:m:s'),
            ]);

            Auth::login($user);

         return redirect()->route('home');
        }
    }
}
