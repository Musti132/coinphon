<?php

namespace App\Http\Requests\Webhook;

use App\Rules\UserOwnsWalletCheck;
use App\Helpers\Response;
use App\Rules\CheckWalletStatus;
use App\Rules\Webhook\CheckIfNameExists;
use App\Rules\Webhook\CheckIfWebhookExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WebhookCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:16', new CheckIfNameExists],
            'endpoint' => ['required', 'string', new CheckIfWebhookExists],
            'wallet_id' => ['required', new UserOwnsWalletCheck, new CheckWalletStatus]
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
