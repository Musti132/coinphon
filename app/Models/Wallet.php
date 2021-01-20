<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function publicKey(){
        return $this->belongsTo(WalletPublicKey::class);
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

}
