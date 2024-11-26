<?php

namespace App\Http\Livewire\Sys\User;

use App\Http\Livewire\Layouts\DynamicContent;

class Content extends DynamicContent
{
    public function render()
    {
        return view('livewire.sys.user.content');
    }
}
