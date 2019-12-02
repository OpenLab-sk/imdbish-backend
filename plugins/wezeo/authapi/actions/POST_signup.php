<?php namespace Wezeo\Authapi\Actions;

use App;
use Event;
use Request;
use RainLab\User\Models\User as RainlabUser;
use Tymon\JWTAuth\Facades\JWTAuth;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_signup {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_signup']))
			return $response;

		$email =    input('email');
		$password = input('password');
		$params = [
			'email' => $email,
		];

		// USAGE:
		//  Event::listen('authapi.beforeUserCreate', function (&$params) {
		//     $params['custom'] = Request::header('custom');
		//  });

		Event::fire('wezeo.authapi.beforeSignup', [&$params]);

		if (RainlabUser::where($params)->first())
			App::abort(401, 'User already exists');

		$params['password']                 = $password;
		$params['password_confirmation']    = $password;

		$user = RainlabUser::create($params);

		Event::fire('wezeo.authapi.afterSignup', [$user]);

		unset( $user['password_confirmation'] );

		$code = $user->activation_code
			? $user->activation_code
			: $user->getActivationCode();

		AuthapiUtils::_mailActivationLink($email, $code);

		$token = JWTAuth::fromUser($user);

		\Event::fire('wezeo.authapi.beforeReturn:user', [&$user]);

		return [
			'success' => 'user created',
			'token' => $token,
			'user' => $user,
		];
	}
}


