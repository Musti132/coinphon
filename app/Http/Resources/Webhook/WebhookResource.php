<?php

namespace App\Http\Resources\Webhook;

use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Wallet\WebhookWalletResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WebhookResource extends JsonResource
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
            'name' => $this->name,
            'endpoint' => $this->endpoint,
            'created_at' => $this->created_at->format('d F Y'),
            'events' => EventResource::collection($this->whenLoaded('events')),
            'wallet' => new WebhookWalletResource($this->whenLoaded('wallet')),
        ];
    }
}
