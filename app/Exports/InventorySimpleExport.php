<?php

namespace App\Exports;

use App\Models\InventorySimple;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InventorySimpleExport implements FromArray, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $invIds;

    public function __construct($invIds)
    {
        $this->invIds = $invIds;
    }

    public function array(): array
    {
        $rows = [];
        $allRows = InventorySimple::whereIn('id', $this->invIds)->where('active', true)
                    ->with(['product', 'warehouse', 'ubication', 'treatment'])
                    ->select('product_id', 'treatment_id', 'ubic_id')
                    ->selectRaw('MAX(warehouse_id) as warehouse_id')
                    ->selectRaw('SUM(qty) as totqta')
                    ->groupBy('product_id', 'treatment_id', 'ubic_id')
                    ->get();
        $allRows = $allRows->sortBy(['product.code', 'treatment.code']);
        foreach ($allRows as $row) {
            $codProd = $row->product->code;
            $descr = $row->product->description;
            $um = $row->product->unit;
            $ubi = $row->ubication->code;
            $treat = $row->treatment->code;
            $mag = $row->warehouse->description;
            $totqta = $row->totqta;
            array_push($rows, [$codProd, $descr, $treat, $ubi, $mag, $um, $totqta]);
        }
        return $rows;
    }

    public function headings(): array
    {
        $head = ['Cod.Prodotto', 'Descr.Prodotto', 'Trattamento', 'Ubicazione', 'Magazzino', 'UM', 'Qta'];
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
            'A' => NumberFormat::FORMAT_NUMBER,
            // 'A' => NumberFormat::FORMAT_TEXT,
        ];
    }


    public function map($row): array
    {
        $body = [strval($row[0]), $row[1], $row[2] ?? '', $row[3] ?? '', $row[4] ?? '', $row[5], $row[6]];
        return $body;
    }
}
