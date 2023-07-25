<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;


use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class SocialAuthController extends Controller
{
     public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $service = new SocialAccountService();
        $user = $service->createOrGetUser(Socialite::driver($provider));
        Auth::login($user);
        // dd(Auth::login($user));
        return redirect(route('classroom.index'));
    }
}
