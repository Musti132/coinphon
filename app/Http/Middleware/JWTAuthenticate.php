<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\User;
use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Token;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
        try {
            //Grab token from cookie and decode
            $rawToken = $request->cookie('token');
            $token = new Token($rawToken);
            $payload = JWTAuth::decode($token);
            $method = $request->method();

            $needToCheckForCSRF = $method == "POST" ? true : ($method == "PUT" ? true : ($method == "DELETE" ? true : ($method == "PATCH" ? true : false)));
            
            if ($needToCheckForCSRF) {
                return Response::forbidden("Token expired, please login again");
                //Make sure user has CSRF token in headers
                if (!$request->hasHeader("X-XSRF-TOKEN")) {
                    return Response::error('Token missing');
                }

                $claimName = config('jwt.name') . 'csrf_claim';

                //Check if CSRF token matches the CSRF token set for user after login
                if ($payload[$claimName] != $request->header("X-XSRF-TOKEN")) throw new TokenMismatchException();
            }

            //Authenticate user
            $user = User::find($payload['sub']);

            Auth::setUser($user, true);
        } catch (TokenExpiredException $ex) {
            return Response::forbidden("Token expired, please login again");
        } catch (TokenMismatchException $ex) {
            return Response::forbidden("Token doesnt match, please login again");
        } catch (TokenBlacklistedException $ex) {
            return Response::forbidden("Token is blacklisted, please login again");
        } catch (TokenInvalidException $ex) {
            return Response::error("Token invalid/not found, please login again");
        } catch (Exception $ex) {
            return Response::error("Unknown error happened with authentication, please contact support");
        }

        return $next($request);
    }
}
