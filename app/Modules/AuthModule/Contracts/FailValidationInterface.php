<?php
namespace App\Modules\AuthModule\Contracts;

use Illuminate\Validation\Validator;

interface FailValidationInterface{
public function execute(Validator $validator);
}