<?php

namespace App\Http\Requests\Order;

use App\Helpers\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewOrderRequest extends FormRequest
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
            'type' => ['string', 'in:bech32,legacy,p2sh-segwit'],
            
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
