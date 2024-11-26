<?php

namespace App\Http\Livewire\Audits;

use LabelHelper;
use WireElements\Pro\Components\SlideOver\SlideOver;

class AuditsSlideOver extends SlideOver
{
    public $ormClass;
    public $ormId;

    public $obj;
    public $logs;
    
    public function render()
    {
        $ormClass = 'App\Models\\' . $this->ormClass;
        $this->obj = $ormClass::find($this->ormId);
        $this->logs = $this->obj->audits()->with('user')->orderBy('created_at', 'desc')->get();
        // dd($this->logs);
        return view('livewire.audits.audits-slide-over');
    }
}
