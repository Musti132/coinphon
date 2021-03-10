<?php

namespace App\Http\Requests\Wallet;

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
            'type' => ['required', 'string', new WalletTypeExist],
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
