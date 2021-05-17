<?php

namespace App\Repository;

use App\Helpers\Response;
use App\Models\UserLogin;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthRepository
{
    

    /**
     * @param Illuminate\Http\Request $request
     * 
     * @return bool
     */
    public function saveUserLogin(Request $request)
    {
        $userAgent = '';
        $agent = new Agent($request->header(), $_SERVER['HTTP_USER_AGENT']);

        if($this->deviceExists($userAgent)){
            return false;
        }

        if($agent->isRobot()){
            return false;
        }

        $hashedDevice = md5($userAgent);

        $expires_at = null;

        if($request->remember){
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

        return true;
    }

    public function requiresSmsAuth(Request $request){

        if(auth()->user()->settings()->get('2fa_enabled') === false){
            return false;
        }

        $device = auth()->user()->devices()->where('device_hash', md5($request->server('HTTP_USER_AGENT')))->where('expires_at', '>=', now())->doesntExist();

        return $device;
    }

    public function deviceExists(string $device){
        return auth()->user()->devices()->where('device_hash', md5($device))->exists();
    }

    public function createLoginCookies($token){
        Cookie::queue(
            "token",
            $token,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            true,
        );

        Cookie::queue(
            "csrf_tkn",
            auth()->payload()->get(config('jwt.name') . 'csrf_claim'),
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
        );

        Cookie::queue(
            "logged_in",
            1,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
        );
    }

    public function createRegisterCookies($token){
        Cookie::queue(
            "token",
            $token,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            true,
        );

        Cookie::queue(
            "csrf_tkn",
            auth()->payload()->get(config('jwt.name') . 'csrf_claim'),
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
        );

        Cookie::queue(
            "logged_in",
            1,
            config('jwt.refresh_ttl'),
            null,
            null,
            false,
            false,
        );
    }

}
