<?php

use Illuminate\Http\Request;

/**
 * This file include route for admin activities(signup, ...)
 */


Route::group([
    'prefix' => 'admin'
], function () {
    
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::post('signup', 'AuthController@signup');
        Route::get('user', 'AuthController@user');
    });
});