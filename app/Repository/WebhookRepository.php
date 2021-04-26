<?php

namespace App\Repository;

use App\Models\Wallet;
use App\Models\Webhook;
use Illuminate\Support\Carbon;
use Str;

class WebhookRepository
{
    public function findWebhook(int $id){
        return Webhook::find($id);
    }

}
