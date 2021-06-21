<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiKey extends Model
{
    use HasFactory, SoftDeletes;

    public const API_KEY_LENGTH = 128;
    public const SECRET_LENGTH = 12;

    protected $fillable = [
        'key',
        'label',
    ];

}
