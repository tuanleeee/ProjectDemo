<?php

namespace App\Exceptions;

use Exception;

class NotExistedTokenException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'Invalid access token'
        ], 401);
    }
}