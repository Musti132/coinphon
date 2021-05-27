<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\NotificationStoreRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function update(NotificationStoreRequest $request)
    {
        $userSettings = auth()->user()->settings();

        $order_new = $request->filled('notification.order_new')
            ? $request->input('notification.order_new')
            : $userSettings->get('order_new');

        $order_completed = $request->filled('notification.order_completed')
            ? $request->input('notification.order_completed')
            : $userSettings->get('order_completed');

        $withdraw = $request->filled('notification.withdraw')
            ? $request->input('notification.withdraw')
            : $userSettings->get('withdraw');

        $userSettings->setMultiple([
            'withdraw' => $withdraw,
            'order_completed' => $order_completed,
            'order_new' => $order_new,
        ]);

        return Response::successMessage('Notifications updated');
    }
}
