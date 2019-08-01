<?php

return array(
    'pagination' => array(
        'items_per_page' => 10
    ),
    
    'image' => array(
        'location' => 'public/image/',
        'file_type' => 'jpeg',
    ),

    'token' => array(
        'key' => 'secret key', // token secret key
        'expiration' => array( // token expire time
            'days' => 1,
            'months' => 0, 
        )
    ),

    'moduleUrl' => array(
        'prefix' => 'api',
        'namespace' => 'App\Modules\AuthModule\Controller',
    ),

    'message' => array(
        '200' => 'Successful',
        '422' => 'Invalid input informations',
        '439' => 'Database not ready or bad query',
        '449' => 'No user found',
        '459' => 'Invalid access token',
        '469' => 'Wrong username or password',
        '479' => 'Unauthorized'
    )
);