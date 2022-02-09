<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationSms;
use App\Models\PhoneNumber;
use App\Models\SmsCode;
use App\Services\AuthService;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{

    public function __construct(public AuthService $authService)
    {
    }

    public function enable(Request $request)
    {
        $phone = PhoneNumber::create([
            'number' => $request->phone,
            'country_id' => $request->country_id,
        ]);

        $sms = SmsCode::create([
            'code' => SmsCode::generateCode(),
            'phone_id' => $phone->id,
            'used' => 0,
            'expires_at' => now()->addMinutes(SmsCode::EXPIRATION_TIME),
        ]);

        SendVerificationSms::dispatch($sms, $phone);

        $length = strlen($phone->number);

        $ending = substr($phone->number, $length - 2, $length);

        return Response::successMessage(
            'Code has been sent to phone number provided, ending in ' . $ending
                . '. Code is valid for ' . SmsCode::EXPIRATION_TIME . ' minutes'
        );

    }

    public function disable()
    {
        auth()->user()->settings()->set('2fa_enabled', false);

        return Response::successMessage('2FA Disabled');
    }

    public function validateCode(Request $request)
    {
        auth()->user()->settings()->set('2fa_enabled', true);


        $phone = auth()->user()->phone()->update([
            'number' => $request->phone,
            'country_id' => $request->country_id,
        ]);

        /*return Response::successMessage(
            'Code has been sent to phone number provided, ending in ' . $ending
                . '. Code is valid for ' . SmsCode::EXPIRATION_TIME . ' minutes'
        );*/
    }
}
