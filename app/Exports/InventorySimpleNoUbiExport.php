<?php

namespace App\Exports;

use App\Models\InventorySimple;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InventorySimpleNoUbiExport implements FromArray, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting, WithCustomCsvSettings
{
    protected $invIds;

    public function __construct($invIds)
    {
        $this->invIds = $invIds;
    }

    public function array(): array
    {
        $rows = [];
        $aProducts = [];
        $aUbi = [];
        $allRows = InventorySimple::whereIn('id', $this->invIds)->with('product')->get();
        foreach ($allRows as $row) {
            $idProd = $row->product_id;
            $codProd = $row->product->code;
            $descr = $row->product->description;
            $um = $row->product->unit;
            if(!in_array($idProd, $aProducts)){
                $totQta = InventorySimple::whereIn('id', $this->invIds)->where('product_id', $idProd)->sum('qty');
                if($totQta>0){
                    array_push($rows, [$codProd, $descr, $um, $totQta]);
                    array_push($aProducts, $idProd);
                }
            }
        }
        return $rows;
    }

    public function headings(): array
    {
        $head = ['Cod.Prodotto', 'Descr.Prodotto', 'UM', 'Qta'];
        return $head;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'A' => NumberFormat::FORMAT_NUMBER,
            'A' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER,
        ];
    }


    public function map($row): array
    {
        $body = [strval($row[0]), $row[1], $row[2], $row[3]];
        return $body;
    }

    public function getCsvSettings(): array
    {
        return [
            // 'delimiter' => "\t"
            // 'input_encoding' => 'ISO-8859-1'
            'delimiter' => ";"
        ];
    }
}
