<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Jobs\SendVerificationSms;
use App\Models\Business;
use App\Models\User;
use App\Models\UserLogin;
use App\Repository\AuthRepository;
use Hash;
use Jenssegers\Agent\Agent;
use Request;
use Twilio\Rest\Client;

class AuthService extends AuthRepository
{
    public function dispatchSms(User $user, UserLogin $device)
    {
        $phone = $user->phone;

        $sms = $this->createSms($phone, $device);

        return SendVerificationSms::dispatch($sms, $phone);
    }

    public function deviceExists(string $userAgent)
    {
        return parent::deviceExists(md5($userAgent));
    }

    public function createUser(RegisterFormRequest $request)
    {
        $country_id = $request->country;

        $data = [
            'first' => $request->first,
            'last' => $request->last,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $country_id,
        ];

        if ($request->filled('business_name')) {

            $business = Business::create([
                'name' => $request->business_name,
            ]);

            $data['is_business'] = true;
            $data['business_id'] = $business->id;
        }

        return User::create($data);
    }

    public function saveLogin(LoginRequest $request)
    {
        //Grab UA and parse it
        $userAgent = $request->header('User-Agent');
        $agent = new Agent($request->header(), $userAgent);

        $device = $this->userDeviceExists($userAgent)->first();

        //If device exists, just return that instead.
        if ($device) {
            return $device;
        }

        // Dont allow bots
        if ($agent->isRobot()) {
            return false;
        }

        $hashedDevice = md5($userAgent);

        $expires_at = null;

        if ($request->remember) {
            $expires_at = now()->addDays(30);
        }

        return $this->saveUserLogin($agent, $request, $hashedDevice, $expires_at);
    }
}
