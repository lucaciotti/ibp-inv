<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InventorySession
 *
 * @property int $id
 * @property string $description
 * @property int $year
 * @property int $month
 * @property string|null $date_start
 * @property string|null $date_end
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryMeasurement> $inventoryMeasurements
 * @property-read int|null $inventory_measurements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventorySessionWarehouse> $inventorySessionWarehouses
 * @property-read int|null $inventory_session_warehouses_count
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySession whereYear($value)
 * @mixin \Eloquent
 */
class InventorySession extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function inventoryMeasurements(): HasMany
    {
        return $this->hasMany(InventoryMeasurement::class, 'inventory_session_id', 'id');
    }

    public function inventorySessionWarehouses(): HasMany
    {
        return $this->hasMany(InventorySessionWarehouse::class, 'inventory_session_id', 'id');
    }
}
