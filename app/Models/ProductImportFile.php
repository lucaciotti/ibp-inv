<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ProductImportFile
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
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile whereDateUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImportFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImportFile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function userCreated()
    {
        return $this->audits()->first()->user;
    }
}
