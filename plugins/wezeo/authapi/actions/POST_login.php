<?php namespace Wezeo\Authapi\Actions;

use App;
use Event;
use Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_login {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_login']))
			return $response;

		$params = [
			'email' => input('email'),
			'password' => input('password'),
		];

		Event::fire('wezeo.authapi.beforeLogin', [&$params]);

		if (!$token = JWTAuth::attempt($params))
			App::abort(401, 'Invalid credentials');

		$user = JWTAuth::authenticate($token);

		if (!$user->is_activated)
			App::abort(401, 'Not activated');

		\Event::fire('wezeo.authapi.beforeReturn:user', [&$user]);

		return [
			'success' => 'Logged in',
			'token' => $token,
			'user' => $user,
		];
	}
}


