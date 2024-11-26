<?php

namespace App\Http\Livewire\Inventory\Statsimple;

use App\Http\Livewire\Layouts\DynamicContent;
use App\Models\InventorySession;
use Session;
use Carbon\Carbon;

class Content extends DynamicContent
{
    public $refresh_table;
    public $invsession_id;
    public $invSessions;

    public $listeners = [
        'dynamic-content.collapse' => 'collapse',
        'dynamic-content.expande' => 'expande',
        'refreshNewPlannedTask' => 'tableHasToBeRefreshed',
        'refreshDatatable' => 'tableRefreshed',
    ];

    
    public function mount(){
        if (!Session::has('inventory.session.id')) {
            $invSession = InventorySession::where('date_start', '<', Carbon::now())->where('date_end', '>', Carbon::now())->first();
            if(!$invSession){
                $invSession = InventorySession::where('date_start', '<', Carbon::now())->first();
            }
            if($invSession) Session::put('inventory.session.id', $invSession->id);
        }
        $this->invsession_id = Session::get('inventory.session.id');
    }

    public function render()
    {
        $this->invSessions= InventorySession::all();
        return view('livewire.inventory.statsimple.content');
    }

    public function updatedInvsessionId(){
        Session::put('inventory.session.id', $this->invsession_id);
        $this->emit('refreshDatatable');
        $this->emit('clearSelected');
    }

    public function tableHasToBeRefreshed()
    {
        $this->refresh_table = true;
    }

    public function tableRefreshed()
    {
        $this->refresh_table = false;
    }
}
