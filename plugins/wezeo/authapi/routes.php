<?php


Route::group(['prefix' => 'api/v1', 'namespace' => 'Wezeo\Authapi\Actions'], function() {

    // API auth (overriden jwtauth api)
    Route::post('/auth/signup',     'POST_signup@handle'     );
    Route::post('/auth/login',      'POST_login@handle'      );
	Route::post('/auth/logout',     'POST_logout@handle'     );
    Route::post('/auth/refresh',    'POST_refresh@handle'    );

    // API auth (rainlab user custom api)
    Route::post('/auth/verify',     'POST_verify@handle'     );  // app api
    Route::get( '/auth/verify',     'POST_verify@handle'     );  // browser link
    Route::post('/auth/resend',     'POST_resend@handle'     );
    Route::post('/auth/forgot',     'POST_forgot@handle'     );
    Route::post('/auth/reset',      'POST_reset@handle'      );  // app api
    Route::get( '/auth/reset',      'POST_reset@handle'      );  // browser link

    Route::group(['middleware' => '\Tymon\JWTAuth\Middleware\GetUserFromToken'], function() {

        Route::get( '/auth/userinfo',   'GET_userinfo@handle'    );
        Route::post('/auth/userinfo',   'POST_userinfo@handle'   );

    });

});




/////////////////////////////////////////////////

