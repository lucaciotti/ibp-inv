<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InventoryMeasurement
 *
 * @property int $id
 * @property int $inventory_session_id
 * @property int $inventory_session_warehouse_id
 * @property int $inventory_ticket_id
 * @property string $ticket
 * @property int $product_id
 * @property int $warehouse_id
 * @property int $ubic_id
 * @property float $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InventorySession|null $inventorySession
 * @property-read \App\Models\InventorySessionTicket|null $inventorySessionTicket
 * @property-read \App\Models\InventorySessionWarehouse|null $inventorySessionWarehouse
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Ubication|null $ubication
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereInventorySessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereInventorySessionWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereInventoryTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereUbicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryMeasurement whereWarehouseId($value)
 * @mixin \Eloquent
 */
class InventoryMeasurement extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function ubication(): HasOne
    {
        return $this->hasOne(Ubication::class, 'id', 'ubic_id');
    }

    public function inventorySession(): HasOne
    {
        return $this->hasOne(InventorySession::class, 'id', 'inventory_session_id');
    }

    public function inventorySessionWarehouse(): HasOne
    {
        return $this->hasOne(InventorySessionWarehouse::class, 'id', 'inventory_session_warehouse_id');
    }

    public function inventorySessionTicket(): HasOne
    {
        return $this->hasOne(InventorySessionTicket::class, 'id', 'inventory_ticket_id');
    }

    // public function inventorySession(): HasOneThrough
    // {
    //     return $this->hasOneThrough(PlanType::class, PlanImportType::class, 'id', 'id', 'import_type_id', 'type_id');
    // }

    // public function planfiletemptasks(): HasMany
    // {
    //     return $this->hasMany(PlanFilesTempTask::class, 'import_file_id', 'id');
    // }
}
