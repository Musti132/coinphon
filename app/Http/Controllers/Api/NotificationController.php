<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;
use App\Models\Notification;
use App\Models\NotificationType;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return NotificationResource::collection(Notification::with('type')->get());
    }

    public function read() {
        $notifications = Notification::where('read', 0)->update([
            'read' => 1,
        ]);

        return Response::success();
    }

    public function destroy(Notification $notification){
        $notification->delete();

        return Response::success();
    }
}
