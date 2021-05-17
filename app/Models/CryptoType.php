<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short',
        'logo_url',
        'style'
    ];

    public function wallets(){
        return $this->belongsToMany(Wallet::class, 'crypto_wallet');
    }

    public function rates(){
        return $this->hasMany(CryptoRate::class, 'crypto_id', 'id');
    }
}
