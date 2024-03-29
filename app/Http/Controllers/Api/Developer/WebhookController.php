<?php

namespace App\Http\Controllers\Api\Developer;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webhook\WebhookCreateRequest;
use App\Http\Requests\Webhook\WebhookDeleteRequest;
use App\Http\Requests\Webhook\WebhookUpdateRequest;
use App\Http\Resources\Webhook\WebhookResource;
use App\Models\Webhook;
use App\Models\Event;
use App\Models\Wallet;
use DB;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = auth()->user()->webhooks()->with(['wallet' => function ($q) {
            $q->select('label', 'uuid', 'id');
        }, 'events'])->orderBy('id', 'desc')->get();

        return WebhookResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebhookCreateRequest $request)
    {
        $wallet = Wallet::with('webhooks')->where('uuid', $request->wallet_id)->first();

        $webhook = new Webhook([
            'name' => $request->name,
            'endpoint' => $request->endpoint,
        ]);

        $wallet->webhooks()->save($webhook);

        return Response::success([
            'webhook' => $webhook,
        ], 'Created new webhook');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function update(WebhookUpdateRequest $request, Webhook $webhook)
    {
        $endpoint = $request->filled('endpoint') ? $request->endpoint : $webhook->endpoint;
        $name = $request->filled('name') ? $request->name : $webhook->name;
        $walletId = $request->filled('wallet_id') ? $request->wallet_id : $webhook->wallet_id;

        $webhook->update([
            'endpoint' => $endpoint,
            'name' => $name,
            'wallet_id' => $walletId
        ]);

        return Response::success([
            'webhook' => $webhook,
        ], 'Webhook updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebhookDeleteRequest $request, Webhook $webhook)
    {
        $webhook->delete();
        
        return Response::successMessage('Webhook deleted');
    }
}
