<?php

namespace App\Http\Resources\Developer\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiShowResource extends JsonResource
{
    public $apiKey;

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
            'label' => $this->label,
            'key' => $this->apiKey,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }

    public function key(string $key) {
        $this->apiKey = $key;

        return $this;
    }
}
