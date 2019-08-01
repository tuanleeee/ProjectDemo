<?php

namespace App\Modules\AuthModule\Contracts;

use App\FailValidationInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


abstract class RequestContract extends FormRequest {
    
    //protected $failMethod;

    public function __construct(FailValidationInterface $failMethod){
;        $this->failMethod = $failMethod;
    }

    protected function failedValidation(Validator $validator) 
    {
        $this->failMethod->execute($validator);
    }
}