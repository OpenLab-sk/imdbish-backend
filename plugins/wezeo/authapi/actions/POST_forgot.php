<?php namespace Wezeo\Authapi\Actions;

use App;
use Illuminate\Http\Request;
use RainLab\User\Models\User as RainlabUser;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_forgot {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_forgot']))
			return $response;

		$email = $request->input('email');

		$user = RainlabUser::where('email', $email)->firstOrFail();

		if (!$user->is_activated)
			App::abort(401, 'User not activated');

		\Event::fire('wezeo.authapi.beforeResetMail', [$user]);

		$code = $user->reset_password_code ?? $user->getResetPasswordCode();

		AuthapiUtils::_mailResetLink($email, $code);

		return [
			'success' => 'Password resetting mail sent'
		];
	}
}


