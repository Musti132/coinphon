<?php

namespace App\Http\Requests\Wallet;

use App\Http\Requests\Traits\HasSortRequest;
use Illuminate\Foundation\Http\FormRequest;

class WalletHistoryRequest extends FormRequest
{
    protected array $allowedColumns = [
        'name',
        'amount',
        'type',
        'date',
    ];


    use HasSortRequest;
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
}
