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
use Exception;
use Flare;
use Log;
use Symfony\Component\ErrorHandler\Debug;
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

        $response = new Response([
            'status' => 'success',
            'message' => 'Authentication successful',
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => $user
            ],
        ]);

        $response->header('Authorization', 'Bearer ' . $token);

        return $response;
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
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                    'user' => $user
                ],
            ]);

            $response->header('Authorization', 'Bearer ' . $token);

            //$this->authRepository->createLoginCookies($token);

            return $response;
        }

        return HelperResponse::forbidden('Username/Password not found.');
    }

    /**
     * Invalidate token & remove cookies to logout user.
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $rawToken = $request->header('Authorization') ?? $request->header('Authorization');

        $rawToken = str_replace('Bearer ', '', $rawToken);

        $token = new Token($rawToken);
        $payload = JWTAuth::decode($token);

        try {

            $currentToken = JWTAuth::getToken();
            $this->guard()->logout();
            JWTAuth::invalidate($currentToken, true);

            return HelperResponse::successMessage('Logged out successfully.');
        } catch (TokenInvalidException $ex) {

            return HelperResponse::successMessage(' out successfully.');
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

            return HelperResponse::success([
                'access_token' => $token,
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]);
        }

        return HelperResponse::error(['error' => 'refresh_token_error']);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
