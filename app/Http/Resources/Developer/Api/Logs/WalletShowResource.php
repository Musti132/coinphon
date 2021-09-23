<?php

namespace App\Http\Resources\Developer\Api\Logs;

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
        ];
    }
}
