<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RandomLib\Factory;

class SmsCode extends Model
{
    use HasFactory;

    const EXPIRATION_TIME = 20; // Minutes

    protected $table = 'sms_codes';

    protected $fillable = [
        'code',
        'phone_id',
        'used',
        'device_id',
        'expires_at'
    ];

    public static function generateCode($length = 6){
        $factory = new Factory;

        $generator = $factory->getMediumStrengthGenerator();

        return $generator->generateString(6, '0123456789');
    }

    public function user(){
        return $this->hasOneThrough(User::class, PhoneNumber::class, 'user_id', 'id', 'phone_id');
    }

    public function isValid(){
        return !$this->used() && !$this->isExpired();
    }

    public function used(){
        return (bool) $this->used;
    }

    public function isExpired(){
        return $this->created_at->diffInMinutes(now() > static::EXPIRATION_TIME);
    }

    public function device(){
        return $this->hasOne(UserLogin::class, 'id', 'device_id');
    }
}
