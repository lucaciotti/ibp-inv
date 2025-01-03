<?php

namespace App\Http\Livewire\Treatments;

use App\Http\Livewire\Layouts\DynamicContent;

class Content extends DynamicContent
{
    public $refresh_table;

    public $listeners = [
        'dynamic-content.collapse' => 'collapse',
        'dynamic-content.expande' => 'expande',
        'refreshNewPlannedTask' => 'tableHasToBeRefreshed',
        'refreshDatatable' => 'tableRefreshed',
    ];

    public function render()
    {
        return view('livewire.treatments.content');
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
