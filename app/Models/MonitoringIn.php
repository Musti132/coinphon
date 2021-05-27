<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringIn extends Model
{
    use HasFactory;

    protected $table = 'api_monitoring_in';

    public function log(){
        return $this->hasOne(ApiLog::class);
    }

    public static function failedCount($walletIds){
        return self::whereIn('wallet_id', $walletIds)->where('code', '!=', 200);
    }

    public static function successCount($walletIds){
        return self::whereIn('wallet_id', $walletIds)->where('code', 200);
    }
}