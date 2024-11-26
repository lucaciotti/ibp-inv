<?php

namespace App\Imports;

use App\Models\Ubication;
use App\Models\Warehouse;
use App\Models\User;
use App\Models\WarehouseImportFile;
use App\Notifications\DefaultMessageNotify;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
use Notification;
use Str;

class WarehousesImport implements ToCollection, WithStartRow, SkipsEmptyRows, WithCalculatedFormulas, WithMultipleSheets, SkipsOnError, WithColumnLimit
{
    protected $importedfile;
    protected $rowNum = 1;
    protected $rules = [];

    public function __construct($id)
    {
        $this->importedfile = WarehouseImportFile::find($id);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $codMag = $row[0];
            $descrMag = $row[1];
            $codUbi = $row[2];
            $descrUbi = $row[3];
            $warehouse = Warehouse::where('code', $codMag)->first();
            if (!$warehouse) {
                $warehouse = Warehouse::create([
                    'code' => $codMag,
                    'description' => $descrMag
                ]);
            }
            if (!Ubication::where('code', $codUbi)->exists()) {
                Ubication::create([
                    'code' => $codUbi,
                    'description' => $descrUbi,
                    'warehouse_id' => $warehouse->id
                ]);
            }
        }
    }
    public function onError(\Throwable $th)
    {
        report($th);
        #INVIO NOTIFICA
        $notifyUsers = User::whereHas('roles', fn ($query) => $query->where('name', 'admin'))->orWhere('id', $this->importedfile->userCreated()->id)->get();
        foreach ($notifyUsers as $user) {
            Notification::send(
                $user,
                new DefaultMessageNotify(
                    $title = 'File di Import - [' . $this->importedfile->filename . ']!',
                    $body = 'Errore: [' . $th->getMessage() . ']',
                    $link = '#',
                    $level = 'error'
                )
            );
        }
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function endColumn(): string
    {
        return 'AZ';
    }
}
