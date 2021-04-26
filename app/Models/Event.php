<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function webhooks(){
        return $this->belongsToMany(Webhook::class, 'webhook_event', 'event_id', 'webhook_id');
    }
}
