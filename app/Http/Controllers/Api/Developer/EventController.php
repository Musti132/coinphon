<?php

namespace App\Http\Controllers\Api\Developer;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webhook\AttachEventRequest;
use App\Models\Webhook;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Attach events for webhooks to listen for.
     * 
     * @param AttachEventRequest $request
     * @param Webhook $webhook
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function attach(AttachEventRequest $request, Webhook $webhook){
        $webhook->events()->sync($request->event_id);

        return Response::successMessage('Successfully added events to webhook');
    }
}
