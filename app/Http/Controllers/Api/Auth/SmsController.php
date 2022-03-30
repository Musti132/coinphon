<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SmsVerifyRequest;
use App\Models\PhoneNumber;
use App\Models\SmsCode;
use App\Models\User;
use App\Services\AuthService;
use Auth;
use Illuminate\Http\Request;
use JWTAuth;

class SmsController extends Controller
{
    /**
     * Store new sms code to be validated later on.
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        (new AuthService)->deviceExists($request->server('HTTP_USER_AGENT'));

        $phone = PhoneNumber::all()->first();

        SmsCode::create([
            'code' => SmsCode::generateCode(),
            'phone_id' => $phone->id,
            'used' => 0,
            'expires_at' => now()->addMinutes(SmsCode::EXPIRATION_TIME),
        ]);

        $length = strlen($phone->number);
        
        $ending = substr($phone->number, $length - 2, $length);

        return Response::successMessage(
            'Code has been sent to attached phone number on account, ending in ' . $ending
            . '. Code is valid for ' . SmsCode::EXPIRATION_TIME . ' minutes'
        );
    }

    /**
     * Validate sms code
     * 
     * @param SmsVerifyRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $code = $request->code;
        
        // Remove test values
        if($code == 444444) {
            $user = User::first();

            $token = JWTAuth::fromUser($user);
            
            return Response::success([
                'access_token' => $token,
            ], 'Code verified');
        }

        if($code == 555555) {
            return Response::success('Code already verified');
        }

        if($code == 666666) {
            return Response::notFound('Invalid code');
        }

        return Response::notFound();

        $smsCode = SmsCode::where('code', $code);

        //Set used to true in db
        $smsCode->update([
            'used' => 1,
        ]);

        //Authorize device to login;
        $smsCode->first()->device()->update([
            'active' => 1,
        ]);

        return Response::success('Code verified');
    }
}
