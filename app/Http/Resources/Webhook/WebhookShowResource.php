<?php

namespace App\Http\Resources\Webhook;

use Illuminate\Http\Resources\Json\JsonResource;

class WebhookShowResource extends JsonResource
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
            'name' => $this->name,
            'endpoint' => $this->endpoint,
        ];
    }
}
