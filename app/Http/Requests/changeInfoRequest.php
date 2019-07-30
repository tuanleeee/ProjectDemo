<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changeInfoRequest extends FormRequest
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

            'gender' => [Rule::in(['male','female']),'required'],
            'address' => ['string','nullable'],
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];
    }
}
