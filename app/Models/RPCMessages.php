<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPCMessages extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "rpc_messages";

    public function log(){
        return $this->belongsTo(RPCLog::class);
    }
}
