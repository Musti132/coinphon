<?php

namespace App\Http\Controllers\Api\Developer;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiCreateRequest;
use App\Http\Requests\Api\ApiUpdateRequest;
use App\Http\Resources\Developer\Api\ApiListResource;
use App\Http\Resources\Developer\Api\ApiShowResource;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use RandomLib\Factory;
use Str;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = auth()->user()->apiKeys()->orderBy('created_at', 'DESC')->get();
        
        return ApiListResource::collection($keys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiCreateRequest $request)
    {
        $factory = new Factory;

        $generator = $factory->getHighStrengthGenerator();

        $actualKey = $generator->generateString(ApiKey::API_KEY_LENGTH, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-');

        $key = 'CNPH'. hash_hmac('sha256', $actualKey, ApiKey::SECRET_LENGTH);

        $api = new ApiKey([
            'label' => $request->label,
            'key' => md5($key),
        ]);

        auth()->user()->apiKeys()->save($api);

        return (new ApiShowResource($api))->key($key);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apikey $api)
    {
        return new ApiShowResource($api);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiUpdateRequest $request, ApiKey $api)
    {
        $api->label = $request->label;
        $api->save();

        return Response::success([
            new ApiShowResource($api)
        ], 'API Key updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apikey $api)
    {
        if($api->user_id != auth()->id()) {
            return Response::forbidden('Forbidden', 'action_unauthorized');
        }

        $api->delete();

        return Response::successMessage('Deleted API key');
    }
}
