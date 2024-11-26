<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\WarehouseImportFile
 *
 * @property int $id
 * @property string $filename
 * @property string $path
 * @property string $status
 * @property string $date_upload
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile whereDateUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseImportFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WarehouseImportFile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function userCreated()
    {
        return $this->audits()->first()->user;
    }
}
