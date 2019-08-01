<?php

namespace App\Modules\AuthModule\Requests;

use App\Modules\AuthModule\Contracts\RequestContract;
use Illuminate\Validation\Rule;

class SignUpRequests extends RequestContract
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
            'username' => ['string','required','unique:sysUsers'],

            'date_of_birth' => ['date','nullable'],
            'image' => ['image','nullable'],

            'gender' => [Rule::in(['male','female']),'required'],
            'user_role' => [Rule::in(['admin','supporter']),'required'],
            
            'address' => ['string','nullable'],
            'email' => 'required|string|email|unique:sysUsers',
            'password' => 'required|string|confirmed'
        ];

        
    }
}
