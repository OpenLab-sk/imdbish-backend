<?php namespace Wezeo\Authapi\Actions;

use Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Wezeo\Authapi\Classes\AuthapiUtils;

class GET_userinfo {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'GET_userinfo']))
			return $response;

		$token = JWTAuth::parseToken()->getToken();
		$user = JWTAuth::toUser($token);

		\Event::fire('wezeo.authapi.beforeReturn:user', [&$user]);

		return [
			'success' => 'User info',
			'user' => $user,
		];
	}
}


