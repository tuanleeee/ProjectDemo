<?php
namespace App\Modules\AuthModules\Contracts;

use Illuminate\Validation\Validator;

interface FailValidationInterfaces{
public function execute(Validator $validator);
}