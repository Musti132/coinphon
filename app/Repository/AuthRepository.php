<?php

namespace App\Repository;

use App\Helpers\Response;
use App\Models\PhoneNumber;
use App\Models\SmsCode;
use App\Models\UserLogin;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthRepository
{

    /**
     * @param Illuminate\Http\Request $request
     * 
     * @return App\Model\UserLogin
     */
    public function saveUserLogin(Request $request)
    {

        //Grab UA and parse it
        $userAgent = $request->header('User-Agent');
        $agent = new Agent($request->header(), $userAgent);

        $device = $this->userDeviceExists($userAgent)->first();

        //If device exists, just return that instead.
        if ($device) {
            return $device;
        }

        if ($agent->isRobot()) {
            return false;
        }

        $hashedDevice = md5($userAgent);

        $expires_at = null;

        if ($request->remember) {
            $expires_at = now()->addDays(30);
        }

        $userLog = new UserLogin([
            'device_hash' => $hashedDevice,
            'browser' => $agent->browser(),
            'os' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => $request->getClientIp(),
            'expires_at' => $expires_at,
        ]);

        auth()->user()->devices()->save($userLog);

        return $userLog;
    }

    public function requiresSmsAuth(Request $request)
    {
        // Only require sms if 2fa is enabled for user.
        if (auth()->user()->settings()->get('2fa_enabled') === false) {
            return false;
        }

        //Does the device already exist and is it activated
        $device = auth()->user()->devices()
            ->where('device_hash', md5($request->server('HTTP_USER_AGENT')))
            ->where('active', 1)
            ->doesntExist();

        return $device;
    }

    public function userDeviceExists(string $device)
    {
        return auth()->user()->devices()->where('device_hash', md5($device));
    }

    public function deviceExists(string $device)
    {
        return UserLogin::where('device_hash', $device)->exists();
    }

    public function createSms(PhoneNumber $phone, UserLogin $device)
    {
        return SmsCode::create([
            'code' => SmsCode::generateCode(),
            'phone_id' => $phone->id,
            'device_id' => $device->id,
            'used' => 0,
            'expires_at' => now()->addMinutes(SmsCode::EXPIRATION_TIME),
        ]);
    }

    public function createLoginCookies($token)
    {

        //Create required cookies to authorize user.
        Cookie::queue(
            "token",
            $token,
            config('jwt.refresh_ttl'),
            null,
            null,
            true,
            true,
            false,
            'none'
        );

        Cookie::queue(
            "csrf_tkn",
            auth()->payload()->get(config('jwt.name') . 'csrf_claim'),
            config('jwt.refresh_ttl'),
            null,
            null,
            true,
            false,
            false,
            'none'
        );

        Cookie::queue(
            "logged_in",
            1,
            config('jwt.refresh_ttl'),
            null,
            null,
            true,
            false,
            false,
            'none'
        );
    }

    public function createRegisterCookies($token)
    {
        Cookie::queue(
            "token",
            $token,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            true,
            false,
            'none'
        );

        Cookie::queue(
            "csrf_tkn",
            auth()->payload()->get(config('jwt.name') . 'csrf_claim'),
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
            false,
            'none'
        );

        Cookie::queue(
            "logged_in",
            1,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
            false,
            'none'
        );
    }
}
