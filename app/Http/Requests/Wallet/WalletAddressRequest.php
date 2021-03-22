<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WalletAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (request()->user()->id === $this->wallet->user_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['string'],
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
