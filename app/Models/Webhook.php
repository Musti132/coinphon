<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webhook extends Model
{
    use HasFactory, SoftDeletes;

    const TABLE = "webhooks";

    protected $fillable = [
        'endpoint',
        'wallet_id',
        'name',
        'domain'
    ];

    public function events(){
        return $this->belongsToMany(Event::class, 'webhook_event', 'webhook_id', 'event_id')->using(WebhookEvent::class);
    }

    public function wallet(){
        return $this->hasOne(Wallet::class, 'uuid', 'wallet_id');
    }
}
