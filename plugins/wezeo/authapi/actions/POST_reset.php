<?php namespace Wezeo\Authapi\Actions;

use App;
use Request;
use RainLab\User\Models\User as RainlabUser;

use Wezeo\Authapi\Classes\AuthapiUtils;

class POST_reset {

	public function handle(Request $request) {

		if ($response = AuthapiUtils::_fireBeforeRequest([$request, 'POST_reset']))
			return $response;

		$email =    input('email');
		$code =     input('code');
		$password = input('password');

		$user =     RainlabUser::where('email', $email)->firstOrFail();

		if (!$user->checkResetPasswordCode($code))
			App::abort(401, 'Invalid code');

		if (!$password) {

			if ($request->isJson())
				App::abort(401, 'Missing new password');

			// default html form fallback, although api use is expected
			return response('<form method="POST">
                        <label>Email:</label><br>
                        <input name="email" disabled value="'.e($email).'"><br>
                        <br>
                        <label>New Password:</label><br>
                        <input name="password" placeholder="Choose new password"><br>
                        <br>
                        <input name="code" type="hidden" value="'.urlencode($code).'">
                        <button>Set new password</button>
                    </form>
                ');
		}

		$user->attemptResetPassword($code, $password);

		return [
			'success' => 'New password set'
		];
	}
}


