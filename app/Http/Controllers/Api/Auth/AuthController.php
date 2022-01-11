<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SmsVerifyRequest;
use App\Http\Resources\User\UserAuthResource;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Business;
use App\Models\PhoneNumber;
use App\Helpers\Response as HelperResponse;
use App\Http\Resources\Wallet\WalletHistoryResource;
use App\Repository\AuthRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Token;
use App\Services\AuthService;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    public $authRepository;
    public $authService;

    /**
     * @param AuthRepository $authRepository
     * @param AuthService $authService
     */
    public function __construct(AuthRepository $authRepository, AuthService $authService)
    {
        $this->authRepository = $authRepository;
        $this->authService = $authService;
    }

    /**
     * Register user
     * 
     * @param RegisterFormRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function register(RegisterFormRequest $request)
    {
        $user = $this->authService->createUser($request);

        $token = auth()->claims([
            config('jwt.name') . "csrf_claim" => Str::random(64),
        ])->login($user);

        $this->authRepository->createRegisterCookies($token);

        return HelperResponse::successMessage('Successfully registered.');
    }

    /**
     * Set csrf claim, check for 2FA, create cookies, then login user
     * 
     * @param LoginRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth()->claims([
            config('jwt.name') . "csrf_claim" => Str::random(64),
        ])->attempt($credentials)) {

            $info = $this->authService->saveLogin($request);

            if ($this->authRepository->requiresSmsAuth($request)) {
                if (!(new AuthService())->dispatchSms(auth()->user(), $info)) {
                    return HelperResponse::error('Failed sending sms', 'sms_failed');
                }

                return HelperResponse::forbidden('Sms auth required', 'sms_required');
            }

            $user = User::with('country', 'business')->where('email', $request->email)->first();

            $response = new Response([
                'status' => 'success',
                'message' => 'Authentication successful',
                'data' => new UserAuthResource($user),
            ]);

            $this->authRepository->createLoginCookies($token);

            return $response;
        }

        return HelperResponse::forbidden('Username/Password not found.');
    }

    /**
     * Invalidate token & remove cookies to logout user.
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function logout() 
    {

        try{
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
                
        } catch(TokenInvalidException $ex) {
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

    }

    /**
     * Return user oject
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
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

    /**
     * Refresh JWT Token (currently not in use)
     * 
     * @return Illuminate\Http\JsonResponse
     */
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
