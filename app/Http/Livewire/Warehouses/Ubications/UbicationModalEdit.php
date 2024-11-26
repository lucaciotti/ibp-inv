<?php

namespace App\Http\Livewire\Warehouses\Ubications;

use App\Models\Ubication;
use App\Models\User;
use App\Notifications\DefaultMessageNotify;
use Auth;
use DB;
use Notification;
use WireElements\Pro\Components\Modal\Modal;

class UbicationModalEdit extends Modal
{
    public $warehouse_id;
    public $ubic;

    public $title;
    public $mode;

    public $code;
    public $description;

    protected $rules = [
        'code' => 'required|unique:ubications',
        'description' => 'required',
    ];

    public function mount($id = null, $warehouse_id)
    {
        $this->warehouse_id = $warehouse_id;
        if (empty($id)) {
            $this->mode = 'insert';
            $this->title = 'Nuova Ubicazione';
        } else {
            $this->mode = 'edit';
            $this->title = 'Modifica Ubicazione [' . $id . ']';
            $this->ubic = Ubication::find($id);
            $this->code = $this->ubic->code;
            $this->description = $this->ubic->description;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        try {
            DB::transaction(
                function () use ($validatedData) {
                    $validatedData = array_merge($validatedData, ['warehouse_id' => $this->warehouse_id]);
                    if (empty($this->ubic)) {
                        $ubic = Ubication::create($validatedData);
                    } else {
                        $this->ubic->update($validatedData);
                    }
                }
            );
        } catch (\Throwable $th) {
            report($th);
            #INVIO NOTIFICA
            $notifyUsers = User::whereHas('roles', fn ($query) => $query->where('name', 'admin'))->orWhere('id', Auth::user()->id)->get();
            foreach ($notifyUsers as $user) {
                Notification::send(
                    $user,
                    new DefaultMessageNotify(
                        $title = 'Creazione Ubicazione - [' . $this->code . ']!',
                        $body = 'Errore: [' . $th->getMessage() . ']',
                        $link = '#',
                        $level = 'error'
                    )
                );
            }
        }

        // $this->dispatch('refreshDatatable');
        $this->close(
            andEmit: [
                'refreshDatatable'
            ]
        );
    }

    public function render()
    {
        return view('livewire.warehouses.ubications.ubication-modal-edit');
    }


    public static function behavior(): array
    {
        return [
            // Close the modal if the escape key is pressed
            'close-on-escape' => true,
            // Close the modal if someone clicks outside the modal
            'close-on-backdrop-click' => false,
            // Trap the users focus inside the modal (e.g. input autofocus and going back and forth between input fields)
            'trap-focus' => true,
            // Remove all unsaved changes once someone closes the modal
            'remove-state-on-close' => false,
        ];
    }

    public static function attributes(): array
    {
        return [
            // Set the modal size to 2xl, you can choose between:
            // xs, sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl
            'size' => '4xl',
        ];
    }
}
