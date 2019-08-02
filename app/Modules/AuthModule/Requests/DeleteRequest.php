<?php

namespace App\Modules\AuthModule\Requests;

use App\Modules\AuthModule\Contracts\RequestContract;
use Illuminate\Validation\UnauthorizedException;

class LoginRequest extends RequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth('api')->user->role == 'supporter')
            throw new UnauthorizedException();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userID' => 'required|string'
        ];
    }
}
