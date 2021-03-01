<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $append = [
        'type'
    ];

    public function publicKey(){
        return $this->belongsTo(WalletPublicKey::class);
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function server(){
        return $this->hasOne(Server::class, 'id');
    }

    public function type(){
        return $this->hasOne(WalletType::class, 'id', 'type_id');
    }

}
