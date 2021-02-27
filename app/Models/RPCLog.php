<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPCLog extends Model
{
    use HasFactory;

    const UPDATED_AT = false;

    protected $guarded = [];
    protected $table = "rpc_logs";
    public $timestamps = false;

    public function message(){
        return $this->hasOne(RPCMessages::class, 'id', 'lod_id');
    }
}
