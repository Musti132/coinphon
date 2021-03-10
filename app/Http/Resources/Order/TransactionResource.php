<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'txid' => $this->txid,
            'received' => $this->received,
            'received_fiat' => $this->received_fiat,
            'from' => $this->from_address,
            'confirmations' => $this->confirmations,
        ];
    }
}
