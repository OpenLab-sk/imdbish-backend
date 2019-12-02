<?php namespace Wezeo\Authapi\Actions;

use Tymon\JWTAuth\Facades\JWTAuth;

class POST_userinfo {

	public function handle() {

		$token = JWTAuth::parseToken()->getToken();
		$user = JWTAuth::toUser($token);

		\Event::fire('wezeo.authapi.postUserInfo', [&$user]);
		\Event::fire('wezeo.authapi.beforeReturn:user', [&$user]);

		return [
			'success' => 'User info',
			'user' => $user,
			'email' => input('email'),
		];
	}
}
