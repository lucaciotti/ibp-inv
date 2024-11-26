<?php

namespace App\Http\Livewire\Warehouses;

use App\Models\Ubication;
use App\Models\User;
use App\Models\Warehouse;
use App\Notifications\DefaultMessageNotify;
use Auth;
use DB;
use Notification;
use WireElements\Pro\Components\Modal\Modal;

class WarehouseModalEdit extends Modal
{
    public $warehouse;

    public $title;
    public $mode;

    public $code;
    public $description;

    protected $rules = [
        'code' => 'required|unique:warehouses',
        'description' => 'required',
    ];

    public function mount($id = null)
    {
        if (empty($id)) {
            $this->mode = 'insert';
            $this->title = 'Nuovo Magazzino';
        } else {
            $this->mode = 'edit';
            $this->title = 'Modifica Magazzino [' . $id . ']';
            $this->warehouse = Warehouse::find($id);
            $this->code = $this->warehouse->code;
            $this->description = $this->warehouse->description;
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
                    if (empty($this->warehouse)) {
                        $warehouse = Warehouse::create($validatedData);
                        $ubic_dafault_code=$this->code.'00#';
                        $ubic_dafault_descr='Default Ubic per Magazzino: '.$this->code;
                        Ubication::create([
                            'code'=> $ubic_dafault_code,
                            'description'=> $ubic_dafault_descr,
                            'warehouse_id'=> $warehouse->id,
                        ]);
                    } else {
                        $this->warehouse->update($validatedData);
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
                        $title = 'Creazione Magazzino - [' . $this->code . ']!',
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
        return view('livewire.warehouses.warehouse-modal-edit');
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
