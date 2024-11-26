<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Ubication
 *
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property int $warehouse_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryMeasurement> $inventoryMeasurement
 * @property-read int|null $inventory_measurement_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductStock> $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductStockArchive> $stocks_archive
 * @property-read int|null $stocks_archive_count
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubication whereWarehouseId($value)
 * @mixin \Eloquent
 */
class Ubication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class, 'ubic_id', 'id');
    }

    public function stocks_archive(): HasMany
    {
        return $this->hasMany(ProductStockArchive::class, 'ubic_id', 'id');
    }

    public function inventoryMeasurement(): HasMany
    {
        return $this->hasMany(InventoryMeasurement::class, 'ubic_id', 'id');
    }

}
