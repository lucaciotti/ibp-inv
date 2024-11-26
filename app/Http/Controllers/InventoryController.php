<?php

namespace App\Http\Controllers;

use App\Exports\InventorySimpleExport;
use App\Exports\InventorySimpleNoUbiExport;
use App\Models\InventorySession;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function confSessions(Request $req)
    {
        return view('mcslide.inventory.sessions');
    }

    // public function invTickets(Request $req)
    // {
    //     return view('mcslide.inventory.tickets');
    // }

    // public function invMeasurements(Request $req)
    // {
    //     return view('mcslide.inventory.measurements');
    // }

    // public function invStats(Request $req)
    // {
    //     return view('mcslide.inventory.stats');
    // }

    public function invMeasurementsSimple(Request $req)
    {
        $invSession = InventorySession::where('date_start', '<', Carbon::now())->where('date_end', '>', Carbon::now())->where('active', true)->first();
        if(!$invSession){
            $invSession = InventorySession::where('date_start', '<', Carbon::now())->where('active', true)->first();
        }
        if ($invSession) $req->session()->put('inventory.session.id', $invSession->id);
        return view('mcslide.inventory.measurements_simple', ['invSession' => $invSession]);
    }

    public function invStatsSimple(Request $req, $id=null)
    {
        if (!empty($id)) {
            $req->session()->put('inventory.session.id', $id);
        } else {
            if(!$req->session()->has('inventory.session.id')){
               $invSession = InventorySession::where('active', true)->first();
                if(!$invSession){
                    $invSession = InventorySession::where('date_start', '<', Carbon::now())->first();
                }
                if($invSession) $req->session()->put('inventory.session.id', $invSession->id);
            }
        }
        $invSession = ($req->session()->has('inventory')) ? InventorySession::find($req->session()->get('inventory.session.id')) : null;
        return view('mcslide.inventory.stats_simple', ['invSession' => $invSession]);
    }

    public function exportXlsSimple(Request $req)
    {
        // dd();
        $inv_ids = $req->session()->get('invsimple.xlsExport.inv_ids');
        $req->session()->forget('invsimple.xlsExport.inv_ids');
        $filename = 'InvSimple_Export_' . Carbon::now()->format('YmdHis') . '.xlsx';
        return Excel::download(new InventorySimpleExport($inv_ids), $filename);
    }

    public function exportCsvNoUbiSimple(Request $req)
    {
        // dd();
        $inv_ids = $req->session()->get('invsimple.xlsExport.inv_ids');
        $req->session()->forget('invsimple.xlsExport.inv_ids');
        $filename = 'Inv_Export_' . Carbon::now()->format('YmdHis') . '.csv';
        return Excel::download(new InventorySimpleNoUbiExport($inv_ids), $filename);
    }
}
