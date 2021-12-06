<?php

namespace App\Http\Requests\Wallet\Manage;

use App\Helpers\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatisticsRequest extends FormRequest
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
            'date_start' => ['numeric'],
            'date_end' => ['gte:date_start', 'numeric', 'required_with:date_start'],
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(Response::validation($validator));
    }
}
