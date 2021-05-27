<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BusinessResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
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
            'id' => $this->id,
            'email' => $this->email,
            'country' => $this->country_name,
            'first' => $this->first,
            'last' => $this->last,
            'settings' => json_decode($this->settings),
            'is_business' => (bool) $this->is_business,
            'business' => new BusinessResource($this->whenLoaded('business')),
            'devices' => DeviceResource::collection($this->whenLoaded('devices')),
        ];
    }
}
