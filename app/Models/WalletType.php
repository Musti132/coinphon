<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WalletType
 *
 * @property int $id
 * @property string $short
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Database\Factories\WalletTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereShort($value)
 * @mixin \Eloquent
 */
class WalletType extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
}
