<?php

namespace App\Http\Livewire\Warehouses\Ubications;

use App\Http\Livewire\Layouts\DynamicContent;
use App\Models\Warehouse;

class Content extends DynamicContent
{
    public $refresh_table;
    public $warehouse;
    
    public $listeners = [
        'dynamic-content.collapse' => 'collapse',
        'dynamic-content.expande' => 'expande',
        'refreshNewPlannedTask' => 'tableHasToBeRefreshed',
        'refreshDatatable' => 'tableRefreshed',
    ];

    public function mount($warehouse_id){
        $this->warehouse = Warehouse::find($warehouse_id);
    }   

    public function render()
    {
        return view('livewire.warehouses.ubications.content');
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
