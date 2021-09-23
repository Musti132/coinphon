<?php

namespace App\Http\Resources\Developer\Api\Logs\Server;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiLogResource extends JsonResource
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
            'host' => $this->host,
            'request' => $this->request,
            'response' => $this->response,
        ];
    }
}
