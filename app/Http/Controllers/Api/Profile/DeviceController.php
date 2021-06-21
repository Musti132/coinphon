<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\DeviceResource;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function devices() {
        return DeviceResource::collection(auth()->user()->devices);
    }
}
