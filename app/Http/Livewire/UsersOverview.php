<?php

namespace App\Http\Livewire;

// use Livewire\Component;
// use WireElements\Pro\Components\Modal\Modal;
use WireElements\Pro\Components\SlideOver\SlideOver;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

class UsersOverview extends SlideOver
{    
    use InteractsWithConfirmationModal;

    public function render()
    {
        return view('livewire.users-overview');
    }

    public static function attributes(): array
    {
        return [
            // Set the modal size to 2xl, you can choose between:
            // xs, sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl
            'size' => 'xl',
        ];
    }

    public function confirmation() { 
        
        $this->askForConfirmation(
            callback: function() {
                return;
            },
            prompt: [
                'title' => __('Warning! Destructive action'),
                'message' => __('Are you sure you want to delete this user?'),
                'confirm' => __('Yes, Delete'),
                'cancel' => __('Stop'),
            ],
            tableHeaders: ['Column 1', 'Column 2'],
            tableData: [
                ['Row 1 - Column 1 Value', 'Row 1 - Column 2 value'],
                ['Row 2 - Column 1 Value', 'Row 2 - Column 2 value'],
            ],
            confirmPhrase: 'DELETE',
            theme: 'warning',
            metaData: [
                'custom' => 'meta data'
            ],
            modalBehavior: [
                'close-on-escape' => false,
                'close-on-backdrop-click' => false,
                'trap-focus' => true,
            ],
            modalAttributes: [
                'size' => '2xl'
            ]
        );
    }

    public function save() {
        return;
    }
}
