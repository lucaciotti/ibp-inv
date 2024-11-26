<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ProductStockArchive
 *
 * @property int $id
 * @property int $product_id
 * @property int $ubic_id
 * @property float $stock
 * @property string|null $date_ref
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $year
 * @property int $month
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereDateRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereUbicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStockArchive whereYear($value)
 * @mixin \Eloquent
 */
class ProductStockArchive extends Model implements Auditable
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
