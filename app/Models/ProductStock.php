<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ProductStock
 *
 * @property int $id
 * @property int $product_id
 * @property int $ubic_id
 * @property float $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $year
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereUbicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereYear($value)
 * @mixin \Eloquent
 */
class ProductStock extends Model implements Auditable
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
}
