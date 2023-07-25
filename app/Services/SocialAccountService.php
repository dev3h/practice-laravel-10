<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {
        // $providerUser = $provider->user();
        $providerUser = $provider->stateless()->user();
        $providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->email,
                    'name' => $providerUser->name ?? $providerUser->nickname,
                    'password' => Hash::make('')
                    // 'avatar' => $providerUser->getAvatar(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}

