<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CoinPhon\Crypto\Wallet\Traits\Wallet as WalletTrait;
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
    use HasFactory, WalletTrait, SoftDeletes;

    protected $hidden = [
        'server_id',
        'full_label',
        'uuid',
    ];

    protected $guarded = [];
    protected $with = [
        'type',
        'server',
        'cryptos'
    ];

    public const STATUS_DEACTIVATED = 0;
    public const STATUS_ACTIVE = 1;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function publicKey()
    {
        return $this->hasOne(WalletPublicKey::class);
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
        return $this->hasOne(Server::class, 'id', 'server_id');
    }

    public function type()
    {
        return $this->hasOne(WalletType::class, 'id', 'type_id');
    }

    public function cryptos() {
        return $this->belongsToMany(CryptoType::class, CryptoWallet::class, 'wallet_id', 'crypto_id');
    }

    public function webhooks(){
        return $this->hasMany(Webhook::class, 'wallet_id', 'uuid');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('uuid', $value)->with('type')->firstOrFail();
    }

    public function monitoringIn(){
        return $this->hasMany(MonitoringIn::class);
    }

    public function monitoringOut(){
        return $this->hasMany(MonitoringOut::class);
    }

    public function getSuccessMonitoringIn(){
        return $this->monitoringIn()->where('code', 200);
    }

    public function getSuccessMonitoringOut(){
        return $this->monitoringOut()->where('code', 200);
    }

    public function getFailedMonitoringIn(){
        return $this->monitoringIn()->where('code', '!=', 200);
    }

    public function getFailedMonitoringOut(){
        return $this->monitoringOut()->where('code', '!=', 200);
    }

    public function active(){
        return $this->where('status', 1);
    }
}
