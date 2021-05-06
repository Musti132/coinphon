<?php

namespace App\Http\Controllers\Api\Developer;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webhook\AttachEventRequest;
use App\Models\Webhook;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function attach(AttachEventRequest $request, Webhook $webhook){
        $webhook->events()->sync($request->event_id);

        return Response::successMessage('Successfully added events to webhook');
    }
}
