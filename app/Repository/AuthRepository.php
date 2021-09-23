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
    public function saveUserLogin(Agent $agent, Request $request, string $hashedDevice, $expires_at)
    {
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
        $httpOnly = $this->shouldBeHttpOnly();
        $secure = $this->shouldBeSecure();
        $sameSite = $this->shouldbeSameSite();
        //Create required cookies to authorize user.
        Cookie::queue(
            "token",
            $token,
            config('jwt.refresh_ttl'),
            null,
            null,
            $secure,
            $httpOnly,
            false,
        );

        Cookie::queue(
            "csrf_tkn",
            auth()->payload()->get(config('jwt.name') . 'csrf_claim'),
            config('jwt.refresh_ttl'),
            null,
            null,
            $secure,
            false,
            false,
            $sameSite,
        );

        Cookie::queue(
            "logged_in",
            1,
            config('jwt.refresh_ttl'),
            null,
            null,
            $secure,
            false,
            false,
            $sameSite,
        );
    }

    public function createRegisterCookies($token)
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
            'none',
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
            'none',
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
            'none',
        );
    }

    private function shouldBeHttpOnly() {
        if(env('APP_ENV') === "local") {
            return false;
        }

        return true;
    }

    private function shouldBeSecure() {
        if(env('APP_ENV') === "local") {
            return false;
        }

        return true;
    }

    private function shouldBeSameSite() {
        return "";
    }
}
