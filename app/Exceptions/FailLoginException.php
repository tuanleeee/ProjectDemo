<?php

namespace App\Exceptions;

use Exception;

class FailLoginException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'Wrong username or password'
        ], 401);
    }
}