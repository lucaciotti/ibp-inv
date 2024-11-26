<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductImportFile;
use App\Models\ProductStock;
use App\Models\Ubication;
use App\Models\User;
use App\Models\Warehouse;
use App\Notifications\DefaultMessageNotify;
use Auth;
use Carbon\Carbon;
use DateTime;
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

class ProductsImport implements ToCollection, WithStartRow, WithChunkReading, SkipsEmptyRows, WithCalculatedFormulas, WithMultipleSheets, SkipsOnError, WithColumnLimit
{
    protected $importedfile;
    protected $rowNum = 1;
    protected $rules = [];

    public function __construct($id)
    {
        $this->importedfile = ProductImportFile::find($id);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // $codUbi = $row[0];
            // $codMag = ucfirst(substr($row[0], 0 ,1));
            // $codProd = $row[1];
            // $descr = $row[2];
            // $um = 'PZ';
            // $stockQta = $row[4];
            $codUbi = '';
            $codMag = '';
            $codProd = $row[0];
            $descr = Str::upper($row[1]);
            $um = Str::upper($row[2]);
            $stockQta = $row[3];
            $barcode = $row[4];

            $year = (new DateTime())->format('Y');

            if($codMag==''){
                $codMag = '00';
            }
            if ($codUbi == '') {
                $codUbi = '00';
            }

            try {
                $warehouse = Warehouse::where('code', $codMag)->first();
                if (!$warehouse) {
                    $warehouse = Warehouse::create([
                        'code' => $codMag,
                        'description' => 'Mag. ' . $codMag
                    ]);
                }
            } catch (\Throwable $th) {
                report($th);
            }

            try {
                $ubic = Ubication::where('code', $codUbi)->first();
                if (!$ubic) {
                    $ubic = Ubication::create([
                        'code' => $codUbi,
                        'description' => 'Ubi. ' . $codUbi,
                        'warehouse_id' => $warehouse->id
                    ]);
                }
            } catch (\Throwable $th) {
                report($th);
            }
            

            try {
                $prod = Product::where('code', $codProd)->first();
                if (!$prod) {
                    $prod = Product::create([
                        'code' => $codProd,
                        'description' => $descr,
                        'unit' => $um,
                        'barcode' => $barcode
                    ]);
                } else {
                    $prod->description = $descr;
                    $prod->unit = $um;
                    $prod->barcode = $barcode;
                    $prod->save();
                }
            } catch (\Throwable $th) {
                report($th);
            }
            

            try {
                $stock = ProductStock::where('product_id', $prod->id)->where('ubic_id', $ubic->id)->where('year', $year)->first();
                if (!$stock) {
                    ProductStock::create([
                        'product_id' => $prod->id,
                        'ubic_id' => $ubic->id,
                        'year' => $year,
                        'stock' => $stockQta
                    ]);
                } else {
                    $stock->stock = $stockQta;
                    $stock->save();
                }
            } catch (\Throwable $th) {
                report($th);
            }

            Log::info('Imported Product Code: '.$codProd);
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

    public function batchSize(): int
    {
        return 500;
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
