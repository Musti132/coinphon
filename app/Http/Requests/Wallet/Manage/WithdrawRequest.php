<?php

namespace App\Http\Requests\Wallet\Manage;

use App\Helpers\Response;
use App\Rules\Wallet\Manage\AddressValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->wallet->user_id === auth()->id());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address' => ['string', 'required', 'min:16', new AddressValidationRule],
            'amount' => ['string', 'required'],
            'note' => ['string', 'max:30'],
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(Response::validation($validator));
    }
}
