<?php

namespace App\Modules\AuthModule\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
