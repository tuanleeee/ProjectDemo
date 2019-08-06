<?php

namespace App\Modules\AuthModule\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Modules\AuthModule\Services\ResponseForm;

class UnauthorizedException extends Exception
{
    public function render():JsonResponse{
	$response = new ResponseForm;
        $response->setMessage("479");
        return $response->getResponse();
    }
}
