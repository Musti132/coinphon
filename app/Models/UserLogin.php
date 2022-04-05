<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'device_hash',
        'browser',
        'os',
        'device',
        'ip'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
