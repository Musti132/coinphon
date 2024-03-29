<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

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
    public const REFUNDED = 4;
    public const COMPLETED = 1;
    public const CONFIRMING = 2;
    public const IN_PROCESS = 0;

    public const FEE_AMOUNT = 1.00;

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

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function getFeeAttribute() {
        return $this->calculateFee();
    }

    public function calculateFee() {
        return number_format((self::FEE_AMOUNT / 100) * $this->amount_fiat, 2);
    }

    public function getStatusMessageAttribute()
    {
        $status = "Unknown";

        $value = $this->attributes['status'];

        switch ($value) {
            case self::CANCELLED:
                $status = "Cancelled";
                break;
            case self::REFUNDED:
                $status = "Refunded";
                break;
            case self::COMPLETED:
                $status = "Completed";
                break;
            case self::CONFIRMING:
                $status = "Confirming";
                break;
            case self::IN_PROCESS:
                $status = "In Process";
                break;
            default:
                $status = "Unknown";
                break;
        }
        
        return $this->attributes['status_message'] = $status;
    }
}
