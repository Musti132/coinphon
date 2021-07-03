<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\ApiNameExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\Response;

class ApiUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->api->user_id == auth()->id()) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => ['required', 'max:32', 'min:4', new ApiNameExists],
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(Response::validation($validator));
    }
}
