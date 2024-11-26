<?php

namespace App\Http\Livewire\PdfReports;

use App\Helpers\PdfReport;
use App\Models\Attribute;
use App\Models\InventorySessionTicket;
use App\Models\PlannedTask;
use App\Models\PlanType;
use Arr;
use Carbon\Carbon;
use Illuminate\Support\Str;
use WireElements\Pro\Components\Modal\Modal;

class GenerateReports extends Modal
{
    public $reportKey;
    public $ticketToPrintIds;
    
    public $reports = [
        'plan' => 'Distinta Pianificazioni (da completare)',
        'plan_ended' => 'Pianificazioni Completare',
        'stat_imp' => 'Statistiche Impianti',
        'stat_ral' => 'Statistiche RAL',
        'stat_imb' => 'Statistiche Imballi',
    ];
    
    public $title = 'Report PDF';
    public $pdfReport;

    protected function do_inv_report() 
    {
        $ticketsToPrint = InventorySessionTicket::whereIn('id', $this->ticketToPrintIds)->with('inventorySessionWarehouse')->get();
        $title = "Tagliandini Inventario";
        $subTitle = '';
        $view = 'mcslide._exports.pdf.inventory_tickets';
        $data = [
            'ticketsToPrint' => $ticketsToPrint,
        ];
        // dd($data);
        $this->pdfReport = $title . '-' . $subTitle . '_' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PdfReport::A4Portrait($view, $data, $title, $subTitle);
        // $pdf->save(base_path('public/tmp_pdf/' . $this->pdfReport));
        $pdf->save(storage_path('app/public/tmp_pdf/' . $this->pdfReport));
    }

    public function mount($reportKey, $params)
    {
        $this->reportKey = $reportKey;
        $this->ticketToPrintIds = (array_key_exists('ticketToPrintIds', $params)) ? $params['ticketToPrintIds'] : [];
        $reportCall = 'do_'.$reportKey.'_report';
        if (is_callable([$this, $reportCall])) {
            $this->$reportCall();
        }
    }

    public function render()
    {
        return view('livewire.pdf-reports.generate-reports');
    }

    public function exitReport(){
        // $delete = unlink(base_path('public/tmp_pdf/' . $this->pdfReport));
        $delete = unlink(storage_path('app/public/tmp_pdf/' . $this->pdfReport));
        if($delete){
            $this->close(true);
        }
    }

    public static function behavior(): array
    {
        return [
            // Close the modal if the escape key is pressed
            'close-on-escape' => false,
            // Close the modal if someone clicks outside the modal
            'close-on-backdrop-click' => false,
            // Trap the users focus inside the modal (e.g. input autofocus and going back and forth between input fields)
            'trap-focus' => true,
            // Remove all unsaved changes once someone closes the modal
            'remove-state-on-close' => true,
        ];
    }

    public static function attributes(): array
    {
        return [
            // Set the modal size to 2xl, you can choose between:
            // xs, sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl
            'size' => 'fullscreen',
        ];
    }
}
