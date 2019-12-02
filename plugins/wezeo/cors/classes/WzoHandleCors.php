<?php namespace Wezeo\CORS\Classes;

class WzoHandleCors {

	public $headers;

	public function __construct() {

		$this->headers = self::_prepareHeaders();
	}

	public function handle($request, \Closure $next) {

		if ($request->isMethod('OPTIONS')) {
			return response('', 200, $this->headers);
		}

		$response = $next($request);
		$response->headers->add($this->headers);

		return $response;
	}

	static public function handle_withHeader() {

		foreach (self::_prepareHeaders() as $k => $v) {
			header($k .': '.$v );
		}
	}

	static function _prepareHeaders() {

		$defaultHeaders = 'Authorization, Content-Type, Origin, Accept-Language, Content-Language';
		$defaultMethods = 'GET, HEAD, POST, PUT, DELETE, CONNECT, OPTIONS, TRACE, PATCH';

		return [
			'Access-Control-Allow-Origin'  => config('wezeo.cors::origin', '*'),
			'Access-Control-Allow-Headers' => config('wezeo.cors::headers', $defaultHeaders),
			'Access-Control-Allow-Methods' => config('wezeo.cors::methods', $defaultMethods),
		];
	}
}
