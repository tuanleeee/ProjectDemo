<?php
namespace App\Modules\AuthModules\Contracts;

use Illuminate\Validation\Validator;

interface FailValidationInterface{
public function execute(Validator $validator);
}