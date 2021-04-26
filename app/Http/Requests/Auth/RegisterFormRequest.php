<?php

namespace App\Http\Requests\Auth;

use App\Rules\CountryCheck;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterFormRequest extends FormRequest
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
            'first' => ['required', 'string', 'max:32'],
            'last' => ['required', 'string', 'max:64'],
            'business_name' => ['string', 'min:4', 'max:64'],
            'country' => ['required', 'string', new CountryCheck],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        
    }

    protected function failedValidation(Validator $validator){
        $message = [
            'status' => 'failed',
            'error' => $validator->errors()->all(),
        ];

        throw new HttpResponseException(response()->json($message, 422));
    }
}
