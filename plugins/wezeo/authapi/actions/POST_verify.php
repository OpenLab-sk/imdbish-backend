<?php namespace Wezeo\Authapi\Actions;

use App;
use RainLab\User\Models\User as RainlabUser;

use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_verify {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_verify']))
			return $response;

		$email = input('email');
		$code =  input('code');

		$user =  RainlabUser::where('email', $email)->firstOrFail();

		if (!$user->attemptActivation($code))
			App::abort(401, 'Invalid code');

		$token = JWTAuth::fromUser($user);

		return [
			'success' => 'User activated',
			'token' => $token,
		];
	}
}


