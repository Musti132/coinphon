<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;

class CryptoTypeResource extends JsonResource
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
            'short' => $this->short,
            'name' => $this->name,
            'logo' => $this->logo_url,
            'style' => $this->style,
        ];
    }
}
