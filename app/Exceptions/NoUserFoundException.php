<?php

namespace App\Exceptions;

use Exception;

class NoUserFoundException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'no user assocciated with input id'
        ], 401);
    }
}
