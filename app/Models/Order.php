<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'amount',
        'amount_fiat',
        'address',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'order_id';
    }

    public function transaction(){
        return $this->hasOne(Transaction::class);
    }

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
}
