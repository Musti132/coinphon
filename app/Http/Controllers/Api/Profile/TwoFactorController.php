<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\TwoAuthVerifyRequest;
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

    // Remove test values

    public function enable(Request $request)
    {
        auth()->user()->settings()->set('2fa_enabled', true);

        /*
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
        );*/


        return Response::successMessage(
            'Code has been sent to phone number provided, ending in 29. Code is valid for ' . SmsCode::EXPIRATION_TIME . ' minutes'
        );
    }

    // Remove test values
    public function disable()
    {
        auth()->user()->settings()->set('2fa_enabled', false);

        return Response::successMessage('2FA Disabled');
    }

    /**
     * @param TwoAuthVerifyRequest $request
     * 
     * @return void
     */
    public function validateCode(Request $request)
    {

        $code = $request->code;

        if ($code == 444444) {
            return Response::success('Code verified');
        }

        if ($code == 555555) {
            return Response::success('Code has already been verified');
        }

        if ($code == 666666) {
            return Response::notFound('Invalid code');
        }

        return Response::notFound();

        $code = $request->code;

        $smsCode = SmsCode::where('code', $code)->firstOrFail();

        if ($smsCode->user_id = !auth()->id()) {
            return Response::notFound();
        }

        if ($smsCode->used == 1) {
            return Response::error('Code has already been verified');
        }

        //Set used to true in db
        $smsCode->update([
            'used' => 1,
        ]);

        auth()->user()->settings()->set('2fa_enabled', true);

        $phone = auth()->user()->phone()->update([
            'number' => $request->phone,
            'country_id' => $request->country_id,
        ]);

        return Response::successMessage(
            'Code verified, 2FA has been enabled.'
        );
    }
}
