<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use CoinPhon\Bitcoin\Wallet\Traits\Wallet as WalletTrait;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, WalletTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first',
        'last',
        'phone_id',
        'country_id',
        'business_id',
        'is_business'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'updated_at',
        'remember_token',
        'hidden'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['country_name'];

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Wallet::class, 'id', 'wallet_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function refresh()
    {
        return $this->hasMany(UserRefreshToken::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
    
    public function getCountryNameAttribute()
    {
        return $this->country->name;
    }

    public function phone()
    {
        return $this->hasOne(PhoneNumber::class, 'id', 'phone_id');
    }

    public function business(){
        return $this->hasOne(Business::class, 'id', 'business_id');
    }
}
