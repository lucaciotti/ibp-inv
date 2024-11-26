<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Warehouse
 *
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryMeasurement> $inventoryMeasurement
 * @property-read int|null $inventory_measurement_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventorySessionWarehouse> $inventorySessionWarehouse
 * @property-read int|null $inventory_session_warehouse_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ubication> $ubications
 * @property-read int|null $ubications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Warehouse extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function ubications(): HasMany
    {
        return $this->hasMany(Ubication::class,'warehouse_id', 'id');
    }

    public function inventoryMeasurement(): HasMany
    {
        return $this->hasMany(InventoryMeasurement::class, 'warehouse_id', 'id');
    }

    public function inventorySessionWarehouse(): HasMany
    {
        return $this->hasMany(InventorySessionWarehouse::class, 'warehouse_id', 'id');
    }
}
