<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\User;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Token;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JWTAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        dd(Auth::user());
        //Make sure user has csrf_token in headers
        if (!$request->hasCookie(config('jwt.name')."csrf")) {
            return Response::error('Token mismatch');
        }
        try{
            $rawToken = $request->cookie(config('jwt.name').'token');
            $token = new Token($rawToken);
            $payload = JWTAuth::decode($token);

            $claimName = config('jwt.name').'csrf_claim';

            //Check if header csrf_token matches the csrf_token set for user after login
            if ($payload[$claimName] != $request->cookie(config('jwt.name')."csrf")) throw new TokenMismatchException();
            
            //Authenticate user by id
            $user = User::find($payload['sub']);

            $token = JWTAuth::fromUser($user);  

            //Auth::loginUsingId($payload['sub'], true);
        } catch(TokenExpiredException $e){
            return Response::forbidden([
                'status' => 'error',
                'message' => 'Unauthorized',
            ]);
        };

        return $next($request);
    }
}
