<?php namespace Wezeo\Authapi\Classes;

use Event;
use Mail;
use Url;

class AuthapiUtils
{

	public static function _fireBeforeRequest($params) {

		$response = Event::fire('wezeo.authapi.beforeRequest', $params);

		if ($response && $response[0])
			return $response[0]->original;
	}

	public static function _makeActivationLink($email, $code) {

//		$link = URL::to('/') . '/api/v1/auth/verify';
//		$link .= '?email='.urlencode($email);
//		$link .= '&code='.urlencode($code);

//		$link = "vacatuner://account/verification/".$email."/".$code;

		return action('Vctuser\Api\Actions\GET_deeplink@handle', [
		    'email' => $email,
            'code' => $code
        ]);
	}

	public static function _makeResetLink($email, $code) {

        return action('Wezeo\Authapi\Actions\POST_reset@handle', [
            'email' => $email,
            'code' => $code
        ]);
	}

	public static function _mailActivationLink($email, $code) {

		$link = static::_makeActivationLink($email, $code);
		Event::fire('wezeo.authapi.extendLink', [&$link]);

		Mail::send('rainlab.user::mail.activate', [
			'name' => $email,
			'code' => $code,
			'link' => $link,
		], function($message) use ($email) {
			$message->to($email);
		});
	}

	public static function _mailResetLink($email, $code) {

		$link = static::_makeResetLink($email, $code);
		Event::fire('wezeo.authapi.extendLink', [&$link]);

		Mail::send('rainlab.user::mail.restore', [
			'name' => $email,
			'code' => $code,
			'link' => $link,
		], function($message) use ($email) {
			$message->to($email);
		});
	}
}
