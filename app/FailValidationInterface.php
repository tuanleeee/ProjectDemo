<?php
namespace App;

use Illuminate\Validation\Validator;

interface FailValidationInterface{
public function execute(Validator $validator);
}