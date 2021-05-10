<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SmsVerifyRequest;
use App\Models\PhoneNumber;
use App\Models\SmsCode;
use App\Services\AuthService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function store()
    {
        $phone = PhoneNumber::all()->first();

        SmsCode::create([
            'code' => SmsCode::generateCode(),
            'phone_id' => $phone->id,
            'used' => 0,
            'expires_at' => now()->addMinutes(SmsCode::EXPIRATION_TIME),
        ]);

        $length = strlen($phone->number);

        $ending = substr($phone->number, $length - 2, $length);

        (new AuthService())->sendFactorSms(auth()->user());

        return Response::successMessage(
            'Code has been sent to attached phone number on account, ending in ' . $ending
            . '. Code is valid for ' . SmsCode::EXPIRATION_TIME . ' minutes'
        );
    }

    public function verify(SmsVerifyRequest $request)
    {
        $code = $request->code;

        dd($code);
    }
}
