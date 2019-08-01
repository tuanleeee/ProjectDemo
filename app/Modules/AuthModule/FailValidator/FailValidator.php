<?php

namespace App\Modules\AuthModule\FailValidator;

use App\/*Modules\AuthModule\Contracts\*/FailValidationInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class FailValidator implements FailValidationInterface{
    public function execute(Validator $validator){
        $errors = (new ValidationException($validator))->errors();
        
        throw new HttpResponseException(response()->json(
            [
                'data' => "",
                'message' => $errors,
                'status_code' => 422,
            ]));
    }
}