<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class DynamicContent extends Component
{
    public $collapsed = false;

    public $listeners = [
        'dynamic-content.collapse' => 'collapse',
        'dynamic-content.expande' => 'expande',
    ];

    public function collapse(){
        $this->collapsed = true;
        $this->render();
    }
    public function expande(){
        $this->collapsed = false;
        $this->render();
    }
}
