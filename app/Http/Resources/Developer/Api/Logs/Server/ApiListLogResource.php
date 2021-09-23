<?php

namespace App\Http\Resources\Developer\Api\Logs\Server;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiListLogResource extends JsonResource
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
            'code' => $this->code,
            'type' => $this->type,
            'path' => $this->path,
            'created_at' => $this->created_at,
            'log' => new ApiLogResource($this->log),
        ];
    }
}
