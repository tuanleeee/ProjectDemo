<?php

namespace App\Modules\AuthModule\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Modules\AuthModule\Services\ResponseForm;

class DatabaseErrorException extends Exception
{
    public function render() : JsonResponse{
        $response = new ResponseForm;
        $response->setMessage("439","Database not ready or bad query");
        return $response->getResponse();
    }
}