<?php

namespace App\Repository;

use App\Models\User;

use Auth0\Login\Auth0User;
use Auth0\Login\Auth0JWTUser;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomUserRepository
{
    protected function upsertUser( $profile ) {
        return User::firstOrCreate([
            'sub' => $profile['sub'] ?? '',
        ]);
    }

    public function getUserByDecodedJWT(array $decodedJwt) : Authenticatable
    {
        $user = $this->upsertUser( $decodedJwt );
        return $user;
    }

    public function getUserByUserInfo(array $userinfo) : Authenticatable
    {
        $user = $this->upsertUser( $userinfo['profile'] );
        return $user;
    }
}