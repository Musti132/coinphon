<?php

namespace App\Http\Requests\Wallet;

use App\Helpers\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\UserLabelExist;
use App\Rules\WalletTypeExist;

class WalletCreate extends FormRequest
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
            'label' => ['required', 'max:64', 'min:4', 'string', new UserLabelExist],
            'crypto_type' => ['required', 'integer', new WalletTypeExist],
            'password' => ['string', 'min:8', 'max:255'],
            'public_key' => ['required_if:wallet_type,external', 'string', 'min:64'],
            'wallet_type' => ['required', 'string', 'in:external,online']

        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
