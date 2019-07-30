<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'username' => ['string','required','unique:users'],

            'date_of_birth' => ['date','nullable'],
            'image' => ['image','nullable'],

            'gender' => [Rule::in(['male','female']),'required'],
            'user_role' => [Rule::in(['admin','supporter']),'required'],
            
            //'phone' => ['regex:/(01)[0-9]{9}/','required'], having trouble with regex, test later
            'address' => ['string','nullable'],
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];

        
    }

    protected function failedValidation(Validator $validator) 
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
