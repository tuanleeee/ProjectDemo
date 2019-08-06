<?php

use Illuminate\Http\Request;

$namespace = 'App\Modules\ChatModule\ChatController';

Route::group(['namespace' => $namespace],function () {
    Route::get('/chat', 'ChatController@index' );
    Route::post('/chat', 'ChatController@postMess');
    Route::get('/supporter', 'ChatController@supporter');
    //Route::get('/ex', function(){return 'Hi, This is from test'});
});
