<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4',],
        ];
    }

    protected function failedValidation(Validator $validator){
        $message = [
            'status' => 'failed',
            'error' => $validator->errors()->all(),
        ];

        throw new HttpResponseException(response()->json($message, 422));
    }

    public function messages(){
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
}
