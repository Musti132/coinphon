<?php

namespace App\Http\Requests\Profile;

use App\Helpers\Response;
use App\Rules\Profile\DeviceExists;
use App\Rules\Profile\UserOwnsDevice;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeviceLogoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->device->user_id === auth()->id());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_id' => ['integer', new UserOwnsDevice],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::validation($validator));
    }
}
