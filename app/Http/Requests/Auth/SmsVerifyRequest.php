<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Response;
use App\Rules\SmsCodeCheck;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SmsVerifyRequest extends FormRequest
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
            'code' => ['required', 'integer', new SmsCodeCheck],
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
