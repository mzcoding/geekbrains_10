<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Social;
use App\Models\User as Model;
use Laravel\Socialite\Contracts\User;

class SocialService implements Social
{
	public function saveUser(User $user): string
	{
		$currentUser = Model::where('email',$user->getEmail())->first();
		if($currentUser) {
			$currentUser->name = $user->getName();
			$currentUser->avatar = $user->getAvatar();
			$currentUser->save();

			\Auth::loginUsingId($currentUser->id);

			return route('account');

		}else {
			//todo: we can implement register feature
		}

		throw new \Exception("User not found");
	}
}