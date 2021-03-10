<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletShowResource extends JsonResource
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
            'id' => $this->uuid,
            'label' => $this->label,
            'balance' => $this->getWallet()->getBalance(),
            'type' => new TypeResource($this->whenLoaded('type')),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
