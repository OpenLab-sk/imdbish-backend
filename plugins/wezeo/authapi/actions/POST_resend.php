<?php namespace Wezeo\Authapi\Actions;

use App;
use Request;
use RainLab\User\Models\User as RainlabUser;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_resend {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_resend']))
			return $response;

		$email = input('email');

		$user = RainlabUser::where('email', $email)->firstOrFail();

		if (!$user)
			App::abort(401, 'User not found');

		if ($user->is_activated)
			App::abort(401, 'User already activated');

		\Event::fire('wezeo.authapi.beforeResend', [$user]);

		$code = $user->activation_code ?? $user->getActivationCode();

		AuthapiUtils::_mailActivationLink($email, $code);

		return [
			'success' => 'Activation mail resent'
		];
	}
}


