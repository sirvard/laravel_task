<?php

namespace App\Services;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;
use App\Contracts\SocialServiceInterface;

class SocialService implements SocialServiceInterface
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id'  => $providerUser->getId(),
                'provider'          => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (! $user) {

                $user = User::create([
                    'email'     => $providerUser->getEmail(),
                    'name'      => $providerUser->getName(),
                    'password'  => ''
                ]);
            }

            $account->user()->associate($user);
            $account->save();
            return $user;
        }

    }
}
