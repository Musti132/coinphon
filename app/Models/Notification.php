<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function type() {
        return $this->hasOne(NotificationType::class, 'id', 'type_id');
    }
}
