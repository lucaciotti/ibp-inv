<?php

namespace App\Http\Livewire\Inventory\Tickets;

use App\Models\InventorySession;
use App\Models\InventorySessionTicket;
use App\Models\InventorySessionWarehouse;
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

class InvTicketsModalPrint extends Modal
{
    public $invSession;
    public $invSessionWarehouses;
    public $list_warehouses;

    public $title;
    public $mode;

    public $inventory_session_id;
    public $warehouse_id;
    public $ticket_printed_old;
    public $ticket_printed=0;
    public $ticket_to_print=0;

    public $ticketToPrintIds=[];

    public function rules(): array {
        return
        [
            'inventory_session_id' => ['required','numeric'],
            'warehouse_id' => ['required','numeric'],
            'ticket_printed' => ['required','numeric'],
            'ticket_to_print' => ['required','numeric'],
        ];
    }

    public function mount($invSession_id = null)
    {
        $this->mode = 'insert';
        $this->title = 'Genera Tagliandini Magazzino';
        $this->invSession = InventorySession::find($invSession_id);
        $this->list_warehouses = Warehouse::all();
        $this->inventory_session_id = $invSession_id;
        $this->warehouse_id = $this->list_warehouses->first()->id ?? 0;
        $this->findInvSessionWarehouses();
    }

    public function findInvSessionWarehouses() {
        $invSessionWarehouses = InventorySessionWarehouse::where('inventory_session_id', $this->inventory_session_id)->where('warehouse_id', $this->warehouse_id)->get();
        if($invSessionWarehouses->isNotEmpty()){
            $this->invSessionWarehouses = $invSessionWarehouses->first();
            $this->ticket_printed_old = $this->invSessionWarehouses->ticket_printed;
        } else {
            $this->invSessionWarehouses = null;
            $this->ticket_printed_old = 0;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function updatedWarehouseId()
    {
        $this->findInvSessionWarehouses();
        $this->ticket_to_print = 0;
    }

    public function save()
    {
        $this->findInvSessionWarehouses();
        $this->ticket_printed = $this->ticket_printed_old + intval($this->ticket_to_print);
        $validatedData = $this->validate();
        try {
            DB::transaction(
                function () use ($validatedData) {
                    if (!$this->invSessionWarehouses) {
                        $this->invSessionWarehouses = InventorySessionWarehouse::create($validatedData);
                    } else {
                        $this->invSessionWarehouses->update($validatedData);
                    }
                    for ($i=1; $i <= $this->ticket_to_print; $i++) {
                        $tmp_n_ticket = $this->ticket_printed_old+$i;
                        $ticket = '24'. str_pad($this->invSessionWarehouses->id, 4, '0', STR_PAD_LEFT) . str_pad($tmp_n_ticket, 7, '0', STR_PAD_LEFT) . '0';
                        $ticketToPrint = InventorySessionTicket::create([
                            'inventory_session_warehouse_id' => $this->invSessionWarehouses->id,
                            'ticket' => $ticket,
                            'num_ticket' => $tmp_n_ticket,
                            'date_printed' => new DateTime(),
                        ]);
                        array_push($this->ticketToPrintIds, $ticketToPrint->id);
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
                        $title = 'Creazione Tagliandini Inventario!',
                        $body = 'Errore: [' . $th->getMessage() . ']',
                        $link = '#',
                        $level = 'error'
                    )
                );
            }
        }

        // $this->dispatch('refreshDatatable');
        $this->emit('modal.open', 'pdf-reports.generate-reports', ['reportKey' => 'inv', 'params'=> ['ticketToPrintIds' => $this->ticketToPrintIds]], ['force' => true]);
        // $this->close();
    }

    public function render()
    {
        return view('livewire.inventory.tickets.invtickets-modal-print');
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
