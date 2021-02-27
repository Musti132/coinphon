<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(RegisterFormRequest $request){

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function login(LoginRequest $request) {

        $credentials = $request->only('email', 'password');
        
        if ($token = auth('api')->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout() {

        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request) {

        if(!$request->user()){
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

    public function refresh() {

        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard() {
        return Auth::guard();
    }

}
