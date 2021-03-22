<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CoinPhon\Bitcoin\Wallet\Traits\Wallet as TraitsWallet;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property string $uuid
 * @property string $label
 * @property string $full_label
 * @property int $type_id
 * @property int $status
 * @property string $user_id
 * @property int $server_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\WalletPublicKey $publicKey
 * @property-read \App\Models\Server|null $server
 * @property-read \App\Models\WalletType|null $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Webhook[] $webhooks
 * @property-read int|null $webhooks_count
 * @method static \Database\Factories\WalletFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereFullLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUuid($value)
 * @mixin \Eloquent
 */
class Wallet extends Model
{
    use HasFactory, TraitsWallet, SoftDeletes;

    protected $guarded = [];
    protected $append = [
        'type'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function publicKey()
    {
        return $this->belongsTo(WalletPublicKey::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'wallet_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function server()
    {
        return $this->hasOne(Server::class, 'id');
    }

    public function type()
    {
        return $this->hasOne(WalletType::class, 'id', 'type_id');
    }

    public function webhooks(){
        return $this->belongsToMany(Webhook::class, 'webhook_wallet');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('uuid', $value)->with('type')->firstOrFail();
    }
}
