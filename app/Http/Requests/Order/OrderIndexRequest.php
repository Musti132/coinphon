<?php

namespace App\Http\Requests\Order;

use App\Helpers\Response;
use App\Http\Requests\Traits\HasSortRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderIndexRequest extends FormRequest
{
    use HasSortRequest;

    protected array $mutateColumns = [
        'status_code' => 'status',
        'date' => 'created_at',
    ];

    protected array $allowedColumns = [
        'date',
        'status_code',
        'amount',
        'amount_fiat'
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
