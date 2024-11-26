<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InventorySessionTicket
 *
 * @property int $id
 * @property int $inventory_session_warehouse_id
 * @property string $ticket
 * @property int|null $num_ticket
 * @property \Illuminate\Support\Carbon $date_printed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InventoryMeasurement|null $inventoryMeasurement
 * @property-read \App\Models\InventorySessionWarehouse|null $inventorySessionWarehouse
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereDatePrinted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereInventorySessionWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereNumTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySessionTicket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InventorySessionTicket extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['date_printed'];


    public function inventorySessionWarehouse(): HasOne
    {
        return $this->hasOne(InventorySessionWarehouse::class, 'id', 'inventory_session_warehouse_id');
    }

    public function inventoryMeasurement(): HasOne
    {
        return $this->hasOne(InventoryMeasurement::class, 'inventory_ticket_id', 'id');
    }
}
