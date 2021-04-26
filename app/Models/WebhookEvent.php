<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WebhookEvent extends Pivot
{
    use HasFactory;

    protected $table = "webhook_event";

    public function webhooks(){
        return $this->belongsToMany(Webhook::class);
    }

    public function events(){
        return $this->belongsToMany(Event::class);
    }
}
