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
    Route::get('getSupporterList','AuthController@getSupporterList');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        
        Route::post('changeUserInfo','AuthController@changeUserInfo');
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