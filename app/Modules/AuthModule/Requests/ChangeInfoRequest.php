<?php

namespace App\Modules\AuthModule\Requests;

use App\Modules\AuthModule\Contracts\RequestContract;
use Illuminate\Validation\Rule;

class ChangeInfoRequest extends RequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'first_name' => ['string','nullable'],
            'middle_name' => ['string','nullable'],
            'last_name' => ['string','nullable'],
            
            'date_of_birth' => ['date','nullable'],
            'image' => ['image','nullable'],

            'gender' => [Rule::in(['male','female'])],
            'address' => ['string','nullable'],
            'email' => 'string|email|unique:users',
            'password' => 'string|confirmed',
        ];
    }
}
