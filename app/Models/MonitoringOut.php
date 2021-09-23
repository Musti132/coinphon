<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringOut extends Model
{
    use HasFactory;

    protected $table = 'api_monitoring_out';

    public function log(){
        return $this->hasOne(ApiLog::class, 'id', 'log_id');
    }

    public static function failedCount($walletIds){
        return self::whereIn('wallet_id', $walletIds)->where('code', '!=', 200);
    }

    public static function successCount($walletIds){
        return self::whereIn('wallet_id', $walletIds)->where('code', 200);
    }
}
