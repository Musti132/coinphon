<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
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
            'hash' => $this->device_hash,
            'device' => $this->device,
            'browser' => $this->browser,
            'os' => $this->os,
            'ip' => $this->ip,
            'logged_in' => $this->updated_at,
            'active' => (bool) $this->active,
        ];
    }
}
