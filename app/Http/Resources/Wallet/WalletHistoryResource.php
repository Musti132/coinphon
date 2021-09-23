<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletHistoryResource extends JsonResource
{
    public static $walletLabel = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->amount === null) {
            $this->amount = 0.00;
        }

        return [
            'label' => self::$walletLabel,
            'type' => $this->type->name,
            'amount' => number_format($this->amount, 2),
            'date' => $this->created_at,
        ];
    }

    public static function customCollection($data, $label) {
        self::$walletLabel = $label;

        return parent::collection($data);
    }
}
