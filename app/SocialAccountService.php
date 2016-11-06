<?php

namespace App;
Use Laravel\Socialite\Contracts\User As ProviderUser;
Class SocialAccountService {
    public function createOrGetuser(ProviderUser $providerUser){
    	$account = User::where('social_id','=',$providerUser->getId())->orWhere('email','=',$providerUser->getEmail())->first();
    	if($account){
    		return $account;
    	}else{
    		$user = User::where('email','=',$providerUser->getEmail())->first();
    		if(!$user){
    			$user = User::create([
    				'isAdmin' => 0,
    				'approved' => 1,
    				'credits' => 0,
    				'name' => $providerUser->getName(),
    				'email' => $providerUser->getEmail(),
    				'social_id' => $providerUser->getId(),
    				'social_type' => 'facebook',
                    'avatar' => $providerUser->getAvatar().'&type=large',
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
    				'password' => bcrypt('rsgrtpassword2016')
    			]);
    		}
    		return $user;
    	}
    }
}