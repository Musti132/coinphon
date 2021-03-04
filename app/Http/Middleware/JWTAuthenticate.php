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
        //Make sure user has csrf_token in headers
        if (!$request->hasCookie(config('jwt.name')."csrf")) {
            return Response::error('Token missing');
        }
        try{
            //Grab token from cookie and decode
            $rawToken = $request->cookie(config('jwt.name').'token');
            $token = new Token($rawToken);
            $payload = JWTAuth::decode($token);

            $claimName = config('jwt.name').'csrf_claim';

            //Check if csrf_token matches the csrf_token set for user after login
            if ($payload[$claimName] != $request->cookie(config('jwt.name')."csrf")) throw new TokenMismatchException();
            
            //Authenticate user
            $user = User::find($payload['sub']);

            Auth::setUser($user, true);
        } catch(TokenExpiredException $e){
            return Response::forbidden();
        };

        return $next($request);
    }
}
