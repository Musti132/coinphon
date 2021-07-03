<?php

namespace App\Http\Requests\Wallet;

use App\Helpers\Response;
use App\Rules\UserLabelExist;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WalletUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (request()->user()->id === $this->wallet->user_id);;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => ['string', 'max:64', 'min:4', new UserLabelExist],
            'public_key' => ['string', 'min:64'],
            'status' => ['integer'],
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
