<?php

namespace App\Modules\AuthModule\Implementations;

use App\Modules\AuthModule\Contracts\FailValidationInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;
use App\Modules\AuthModule\Services\ResponseForm;

class FailValidator implements FailValidationInterface{
    public function execute(Validator $validator){
        $errors = (new ValidationException($validator))->errors();

        $response = new ResponseForm();
        $response->addData(collect($errors));
        $response->setMessage('422');
        
        throw new HttpResponseException($response->getResponse());
    }
}