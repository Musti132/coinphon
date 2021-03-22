<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServerRegion
 *
 * @property int $id
 * @property int $region
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ServerRegionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServerRegion extends Model
{
    use HasFactory;

    protected $primaryKey = 'region';
}
