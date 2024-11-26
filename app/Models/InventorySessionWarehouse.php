<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InventorySessionWarehouse
 *
 * @property int $id
 * @property int $inventory_session_id
 * @property int $warehouse_id
 * @property int $ticket_printed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryMeasurement> $inventoryMeasurements
 * @property-read int|null $inventory_measurements_count
 * @property-read \App\Models\InventorySession|null $inventorySession
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventorySessionTicket> $inventorySessionTickets
 * @property-read int|null $inventory_session_tickets_count
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse whereInventorySessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse whereTicketPrinted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionWarehouse whereWarehouseId($value)
 * @mixin \Eloquent
 */
class InventorySessionWarehouse extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function inventorySession(): HasOne
    {
        return $this->hasOne(InventorySession::class, 'id', 'inventory_session_id');
    }

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function inventorySessionTickets(): HasMany
    {
        return $this->hasMany(InventorySessionTicket::class, 'inventory_session_warehouse_id', 'id');
    }

    public function inventoryMeasurements(): HasMany
    {
        return $this->hasMany(InventoryMeasurement::class, 'inventory_session_warehouse_id', 'id');
    }
}
