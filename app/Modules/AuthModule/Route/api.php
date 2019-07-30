<?php

use Illuminate\Http\Request;


/**
 * This file include route for admin activities(signup, ...)
 */

$namespace = 'App\Modules\AuthModule\Controller';
Route::group([
    'namespace' => $namespace,
    'prefix' => 'admin'
], function () {
    Route::get('getUser/{id}','AuthController@getUser');
    Route::post('signUp', 'AuthController@signup');
    Route::get('supporterList','AuthController@getOnlineList');
    Route::get('getUserList','AuthController@getUserList');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        
        Route::get('userInfo', 'AuthController@user');
    });
});

/**
 * comment cu chuoi !!!!!!
 * 
 */

Route::group([
    'namespace' => $namespace,
    'prefix'=>'auth'],
    function(){
        Route::post('login','AuthController@login');

        Route::group([
           'middleware' => 'auth:api'
         ],function(){
             Route::get('logout','AuthController@logout');
           });
    }
);