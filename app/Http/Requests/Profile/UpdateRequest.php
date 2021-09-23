<?php

namespace App\Http\Requests\Profile;

use App\Helpers\Response;
use App\Rules\Profile\CurrentPasswordCheck;
use App\Rules\Profile\EmailCheck;
use App\Rules\Profile\IsBusinessProfile;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
            'email' => ['string', new EmailCheck],
            'password' => ['string', 'min:8', 'confirmed'],
            'current_password' => ['string', 'min:8', 'required', new CurrentPasswordCheck],
            'business_name' => ['string', 'min:6', new IsBusinessProfile]
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
