<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'user_name' => ['string','required','unique'],

            'date_of_birth' => ['date','nullable'],

            'gender' => [Rule::in(['male','female']),'required'],
            'user_role' => [Rule::in(['admin','supporter']),'required'],
            
            //'phone' => ['regex:/(01)[0-9]{9}/','required'], having trouble with regex, test later
            'address' => ['string','nullable'],
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];
    }
}
