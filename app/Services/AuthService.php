<?php

namespace App\Services;

use App\Jobs\SendVerificationSms;
use App\Models\User;
use App\Models\UserLogin;
use App\Repository\AuthRepository;
use Twilio\Rest\Client;

class AuthService extends AuthRepository
{
    public function dispatchSms(User $user, UserLogin $device)
    {
        $phone = $user->phones()->first();

        $sms = $this->createSms($phone, $device);

        return SendVerificationSms::dispatch($sms, $phone);
    }

    public function deviceExists(string $userAgent){
        return parent::deviceExists(md5($userAgent));
    }
}
