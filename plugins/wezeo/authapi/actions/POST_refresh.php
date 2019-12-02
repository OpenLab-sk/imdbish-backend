<?php namespace Wezeo\Authapi\Actions;

use App;
use Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_refresh {

	public function handle(Request $request) {
		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_refresh']))
			return $response;

		$token = JWTAuth::parseToken()->getToken();

		// attempt to refresh the JWT
		if (!$newToken = JWTAuth::refresh($token)) {
			App::abort(401, 'Could not refresh token');
		}

		$user = JWTAuth::toUser($newToken);

		return [
			'success' => 'Token refreshed',
			'token' => $newToken,
			'user' => $user,
		];
	}
}


