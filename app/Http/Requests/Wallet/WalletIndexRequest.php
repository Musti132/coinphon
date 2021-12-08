<?php

namespace App\Http\Requests\Wallet;

use App\Helpers\Response;
use App\Http\Requests\Traits\HasSortRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WalletIndexRequest extends FormRequest
{
    use HasSortRequest;

    protected array $mutateColumns = [
        'created' => 'created_at',
        'wallet_type' => 'type_id'
    ];

    protected array $allowedColumns = [
        'status',
        'wallet_type',
        'created',
    ];

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
            'sort_by' => ['string', 'max:16'],
            'sort_order' => ['in:asc,desc'],
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Response::validation($validator));
    }
}
