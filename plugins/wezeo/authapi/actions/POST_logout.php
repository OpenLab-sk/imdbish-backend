<?php namespace Wezeo\Authapi\Actions;

use Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_logout {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_logout']))
			return $response;

		$token = JWTAuth::parseToken()->getToken();
		JWTAuth::invalidate($token);


		return [
			'success' => 'Logged out',
		];
	}
}


