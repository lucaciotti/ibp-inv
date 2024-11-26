<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InventorySimple
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $ubication
 * @property float $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple whereUbication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventorySimple whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InventorySimple extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function userCreated()
    {
        return $this->audits()->first()->user;
    }
}
