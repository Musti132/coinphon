<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Wallet\WalletShowResource;
use App\Http\Resources\Order\TransactionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'id' => $this->order_id,
            'amount' => $this->amount,
            'amount_fiat' => $this->amount_fiat,
            'address' => $this->address,
            'status' => $this->status,
            'note' => 'Hello',
            'fee' => "0.0000412",
            'fee_fiat' => $this->fee,
            'created_at' => $this->created_at->format('D, M Y, m:h'),
            'wallet' => new WalletShowResource($this->wallet),
            'transaction' => new TransactionResource($this->whenLoaded('transaction')),
        ];
    }
}
