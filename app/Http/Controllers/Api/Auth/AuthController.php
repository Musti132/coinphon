<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserAuthResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Business;
use App\Models\PhoneNumber;
use App\Helpers\Response as HelperResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Token;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $country_id = $request->country;

        $data = [
            'first' => $request->first,
            'last' => $request->last,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $country_id,
        ];

        if ($request->filled('business_name')) {
            
            $business = Business::create([
                'name' => $request->business_name,
            ]);

            $data['is_business'] = true;
            $data['business_id'] = $business->id;
        }

        $user = User::create($data);

        $token = JWTAuth::fromUser($user);

        return HelperResponse::successMessage('Successfully registered.');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth()->claims([
            config('jwt.name') . "csrf_claim" => Str::random(64),
            ])->attempt($credentials)) {
            //return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
            $response = new Response([
                'status' => 'success',
                'message' => 'Authentication successful'
            ]);

            Cookie::queue(
                "token",
                $token,
                config('jwt.refresh_ttl'),
                null,
                null,
                false,
                true,
            );

            Cookie::queue(
                "csrf_tkn",
                auth()->payload()->get(config('jwt.name') . 'csrf_claim'),
                config('jwt.refresh_ttl'),
                null,
                null,
                false,
                false,
            );

            Cookie::queue(
                "logged_in",
                1,
                config('jwt.refresh_ttl'),
                null,
                null,
                false,
                false,
            );

            return $response;
        }

        return HelperResponse::forbidden('Username/Password not found.');
    }

    public function logout()
    {
        $this->guard()->logout();
        JWTAuth::invalidate(JWTAuth::parseToken());

        Cookie::queue(
            "logged_in",
            0,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
        );

        return HelperResponse::successMessage('Logged out successfully.')
            ->withCookie(Cookie::forget('token'))
            ->withCookie(Cookie::forget('csrf_tkn'));
    }

    public function user(Request $request)
    {

        if (!$request->user()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Permission denied'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => new UserAuthResource($request->user()->load(['country', 'business'])),
        ]);
    }

    public function refresh()
    {
        $currentToken = JWTAuth::getToken();

        if ($token = JWTAuth::refresh($currentToken)) {

            $response = new Response(['status' => 'success']);

            Cookie::queue(
                "token",
                $token,
                config('jwt.refresh_ttl'),
                null,
                null,
                false,
                true,
            );

            return $response;
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
