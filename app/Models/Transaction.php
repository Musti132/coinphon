<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'txid',
        'received',
        'received_fiat',
        'confirmations',
        'from_address',
        'order_id',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
