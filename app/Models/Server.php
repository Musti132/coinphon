<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Server
 *
 * @property int $id
 * @property string $label
 * @property string $host
 * @property int $port
 * @property int $region_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ServerRegion|null $region
 * @method static \Database\Factories\ServerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Server newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Server newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Server query()
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Server extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function region(){
        return $this->hasOne(ServerRegion::class, 'id');
    }
}
