<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $order_id
 * @property int $wallet_id
 * @property string $amount
 * @property string $amount_fiat
 * @property string $address
 * @property int $status
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Transaction|null $transaction
 * @property-read \App\Models\Wallet $wallet
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmountFiat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereWalletId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    public const CANCELLED = 3;
    public const REFUNDED = 6;
    public const COMPLETED = 1;
    public const CONFIRMING = 2;

    protected $fillable = [
        'wallet_id',
        'amount',
        'amount_fiat',
        'address',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'order_id';
    }

    public function transaction(){
        return $this->hasOne(Transaction::class);
    }

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
}
