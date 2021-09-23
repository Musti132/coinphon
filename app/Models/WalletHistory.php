<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    use HasFactory;

    protected $table = 'wallet_history';

    public function wallet() {
        return $this->belongsTo(Wallet::class, 'uuid', 'wallet_id');
    }

    public function type() {
        return $this->hasOne(WalletHistoryType::class, 'id', 'type_id');
    }
}
