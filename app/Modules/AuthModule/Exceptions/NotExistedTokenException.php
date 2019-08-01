<?php

namespace App\Modules\AuthModule\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Modules\AuthModule\Services\ResponseForm;


class NotExistedTokenException extends Exception
{
    public function render() : JsonResponse{
        $response = new ResponseForm;
        $response->setMessage("459");
        return $response->getResponse();
    }
}