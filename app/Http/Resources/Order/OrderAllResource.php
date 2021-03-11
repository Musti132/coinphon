<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Wallet\WalletShowResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderAllResource extends JsonResource
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
            'amount' => $this->amount,
            'amount_fiat' => $this->amount_fiat,
            'address' => $this->address,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'wallet' => new WalletShowResource($this->wallet),
            'transaction' => new TransactionResource($this->whenLoaded('transaction')),
        ];
    }
}