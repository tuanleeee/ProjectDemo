<?php

use Illuminate\Http\Request;


/**
 * This file include route for admin activities(signup, ...)
 */


Route::group([
    'namespace' => config('AuthModule_config.moduleUrl.namespace'),
    'prefix' => config('AuthModule_config.moduleUrl.prefix')
],
function(){

    
    Route::get('getUser/{id}','AuthController@getUser');
    Route::post('signUp', 'AuthController@signup');
    Route::get('getSupporterList','AuthController@getSupporterList');
    Route::post('login','AuthController@login');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
      
        Route::post('changeUserInfo','AuthController@changeUserInfo');
        Route::get('userInfo', 'AuthController@user');
        Route::get('logout','AuthController@logout');
        Route::post('delete','AuthController@delete');
    });
});

