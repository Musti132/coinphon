<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CoinPhon\Bitcoin\Wallet\Traits\Wallet as TraitsWallet;

class Wallet extends Model
{
    use HasFactory, TraitsWallet;

    protected $guarded = [];
    protected $append = [
        'type'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function publicKey()
    {
        return $this->belongsTo(WalletPublicKey::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function server()
    {
        return $this->hasOne(Server::class, 'id');
    }

    public function type()
    {
        return $this->hasOne(WalletType::class, 'id', 'type_id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('uuid', $value)->with('type')->firstOrFail();
    }
}
