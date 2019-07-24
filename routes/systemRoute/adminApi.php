<?php

use Illuminate\Http\Request;

/**
 * This file include route for admin activities(signup, ...)
 */


Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('signup', 'AuthController@signup');
    Route::get('supporter_list','SupporterController@getOnlineList');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        
        Route::get('user', 'AuthController@user');
    });
});