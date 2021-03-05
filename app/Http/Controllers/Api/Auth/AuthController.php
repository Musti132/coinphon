<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);


        return response()->json([
            'status' => 'success',
        ], 200)->header('Authorization', $token);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth('api')->claims([config('jwt.name')."csrf_claim" => Str::random(32)])->attempt($credentials)) {
            //return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
            $response = new Response(['status' => 'success']);

            $response->withCookie(
                config('jwt.name')."token",
                $token,
                config('jwt.ttl'),
                '/'
            );

            $response->withCookie(
                config('jwt.name')."csrf",
                auth()->payload()->get(config('jwt.name').'csrf_claim'),
                config('jwt.refresh_ttl'),
                '/'
            );

            return $response;
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {

        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out Successfully.'
        ], 200);
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
            'data' => $request->user(),
        ]);
    }

    public function refresh()
    {
        return Auth::guard()->refresh();
        if ($token = $this->guard()->refresh()) {
            $response = new Response(['status' => 'success']);

            $response->withCookie(
                config('jwt.name'),
                $token,
                config('jwt.refresh_ttl'),
                '/'
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
