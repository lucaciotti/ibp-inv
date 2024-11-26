<?php

namespace App\Http\Livewire\Inventory\Sessions;

use App\Models\InventorySession;
use App\Models\Ubication;
use App\Models\User;
use App\Models\Warehouse;
use App\Notifications\DefaultMessageNotify;
use Auth;
use DateTime;
use DB;
use Illuminate\Validation\Rule;
use Notification;
use WireElements\Pro\Components\Modal\Modal;

class InvSessionModalEdit extends Modal
{
    public $invSession;

    public $title;
    public $mode;

    public $list_years;
    public $list_months = [
        1 => 'Gennaio',
        2 => 'Febbraio',
        3 => 'Marzo',
        4 => 'Aprile',
        5 => 'Maggio',
        6 => 'Giugno',
        7 => 'Luglio',
        8 => 'Agosto',
        9 => 'Settembre',
        10 => 'Ottobre',
        11 => 'Novembre',
        12 => 'Dicembre',
    ];

    public $description;
    public $year;
    public $month;
    public $date_start;
    public $date_end;
    public $active;

    public function rules(): array {
        if ($this->mode == 'edit') {
            return [
                'year' => ['required', 'numeric'],
                'month' => ['required', 'numeric'],
                'description' => 'required',
                'date_start' => 'nullable|date',
                'date_end' => 'nullable|date|after:date_start',
                'active' => 'required|unique:inventory_sessions,active,'. $this->invSession->id,
            ];
        } else {
            return [
                'year' => ['required', 'numeric'],
                'month' => ['required', 'numeric', Rule::unique('inventory_sessions', 'month')->where('year', $this->year),],
                'description' => 'required',
                'date_start' => 'nullable|date',
                'date_end' => 'nullable|date|after:date_start',
                'active' => 'required|unique:inventory_sessions,active',
            ];
        }
    }

    public function messages()
    {
        return [
            'month.unique' => 'Sessione di inventario già presente per questa combinazione di mese / anno.',
            'active.unique' => 'Sessione di inventario attiva già presente.',
        ];
    }

    public function mount($id = null)
    {
        $this->list_years = range(2023, 2050);
        if (empty($id)) {
            $this->mode = 'insert';
            $this->title = 'Nuova Sessione Inventario';
            $this->year=intval((new DateTime())->format('Y'));
            $this->month=intval((new DateTime())->format('m'));
        } else {
            $this->mode = 'edit';
            $this->title = 'Modifica Sessione Inventario [' . $id . ']';
            $this->invSession = InventorySession::find($id);
            $this->description = $this->invSession->description;
            $this->year = $this->invSession->year;
            $this->month = $this->invSession->month;
            $this->date_start = $this->invSession->date_start;
            $this->date_end = $this->invSession->date_end;
            $this->active = $this->invSession->active;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        // if (!empty($this->invSession)) {
        //     $rules = [
        //         'year' => ['required','numeric'],
        //         'month' => ['required','numeric'],
        //         'description' => 'required',
        //         'date_start' => 'nullable|date',
        //         'date_end' => 'nullable|date|after:date_start',
        //         'active' => 'required|unique',
        //     ];
        //     $validatedData = $this->validate($rules);
        // } else {
        // }
        $validatedData = $this->validate();
        try {
            DB::transaction(
                function () use ($validatedData) {
                    if (empty($this->invSession)) {
                        $invSession = InventorySession::create($validatedData);
                    } else {
                        $this->invSession->update($validatedData);
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
                        $title = 'Creazione Sessione Inventario - [' . $this->description . ']!',
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
        return view('livewire.inventory.sessions.invsession-modal-edit');
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
