<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class OrderListResource extends JsonResource
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
            'status' => $this->status_message,
            'status_code' => $this->status,
            'name' => Str::random(6),
        ];
    }
}
