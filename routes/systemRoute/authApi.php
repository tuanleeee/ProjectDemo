<?php

use Illuminate\Http\Request;

/**
 * This file include route for authentication activities(login, logout, ...)
 */

 Route::group([
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