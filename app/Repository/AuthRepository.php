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
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36';
        $agent = new Agent($request->header(), $userAgent);

        if($this->deviceExists($userAgent)){
            return false;
        }

        if($agent->isRobot()){
            return false;
        }

        $hashedDevice = md5($userAgent);

        $userLog = new UserLogin([
            'device_hash' => $hashedDevice,
            'browser' => $agent->browser(),
            'os' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => $request->getClientIp(),
        ]);

        auth()->user()->devices()->save($userLog);

        return true;
    }

    public function requiresSmsAuth(Request $request){

        if(auth()->user()->settings()->get('2fa_enabled') === false){
            return false;
        }

        $hash = auth()->user()->devices()->where('device_hash', md5($request->server('HTTP_USER_AGENT')))->doesntExist();

        return $hash;
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
