<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Developer\Api\Logs\Server\ApiListLogResource as ApiServerLogs;
use App\Http\Resources\Developer\Api\Logs\User\ApiListLogResource as ApiUserLogs;
use App\Models\ApiLog;
use App\Models\MonitoringIn;
use App\Models\MonitoringOut;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function server() {
        $monitoring = MonitoringOut::with('log')->get();

        return ApiServerLogs::collection($monitoring);
    }

    public function user() {
        $monitoring = MonitoringIn::with('log')->get();

        return ApiUserLogs::collection($monitoring);
    }
}
