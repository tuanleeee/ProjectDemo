<?php

use Illuminate\Http\Request;

/**
 * This file include route for admin activities(signup, ...)
 */


function () {
            Route::group([
              'middleware' => 'auth:api'
            ], function() {
                Route::post('signup', 'AuthController@signup');

                
                //user hasnt been modified yet
                Route::get('user', 'AuthController@user');
            
            });
        };