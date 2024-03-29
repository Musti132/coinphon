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
use Illuminate\Support\Facades\Cookie;
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
            $rawToken = $request->header('Authorization') ?? $request->header('Authorization');

            $rawToken = str_replace('Bearer ', '', $rawToken);

            $token = new Token($rawToken);
            $payload = JWTAuth::decode($token);
            $method = $request->method();

            //Do we actually need to check for csrf dude?
            $needToCheckForCSRF =
                $method == "POST" ? true : ($method == "PUT" ? true : ($method == "DELETE" ? true : ($method == "PATCH" ? true : false)));

            if ($needToCheckForCSRF && env('APP_DEBUG') !== true) {

                //Make sure user has CSRF token in headers
                if (!$request->hasHeader("X-XSRF-TOKEN")) {
                    return Response::error('CSRF token missing');
                }

                $claimName = config('jwt.name') . 'csrf_claim';

                //Check if CSRF token matches the CSRF token set for user after login
                if ($payload[$claimName] != $request->header("X-XSRF-TOKEN")) throw new TokenMismatchException("Invalid CSRF-TOKEN");
            }

            //Authenticate user

            if (!Auth::onceUsingId($payload['sub'], true)) {
                return Response::forbidden('Permission denied');
            }
        } catch (TokenExpiredException $ex) {
            if($request->route()->getAction('as') == "auth.refresh") {
                return $next($request);
            }
            
            return Response::forbidden('Token has expired', 'token_expired');
        } catch (TokenMismatchException $ex) {
            return Response::forbidden("CSRF/Access token doesnt match, please login");
        } catch (TokenBlacklistedException $ex) {
            return Response::forbidden("Access token is blacklisted, please login again");
        } catch (TokenInvalidException $ex) {
            return Response::forbidden("Access token invalid/not found, please login");
        } catch (Exception $ex) {
            return Response::error($ex->getMessage());
        }


        return $next($request);
    }
}
