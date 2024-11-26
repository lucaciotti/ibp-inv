<?php

namespace App\Http\Livewire\Inventory\Measurement;

use App\Http\Livewire\Layouts\DynamicContent;
use App\Models\InventoryMeasurement;
use App\Models\InventorySessionTicket;
use App\Models\Product;
use App\Models\Ubication;
use Str;

class Content extends DynamicContent
{
    public $barcode;
    public $codMag;
    public $codProd;
    public $descrProd;
    public $umProd = 'PZ';
    public $codUbi;
    public $year;
    public $month;
    public $periodo;
    
    public $invSessionTicket;
    public $invSessionWarehouse;
    public $invMeasurements;
    public $invSession;
    public $product;
    public $ubication;
    public $productStock;

    # Create Sparata
    public $inventory_session_id;
    public $inventory_session_warehouse_id;
    public $inventory_ticket_id;
    public $ticket;
    public $product_id;
    public $warehouse_id;
    public $ubic_id;
    public $qty;

    public function rules(): array
    {
        return
            [
            'inventory_session_id' => ['required', 'numeric'],
            'inventory_session_warehouse_id' => ['required', 'numeric'],
            'inventory_ticket_id' => ['required', 'numeric'],
            'product_id' => ['required', 'numeric'],
            'warehouse_id' => ['required', 'numeric'],
            'ubic_id' => ['required', 'numeric'],
            'qty' => ['required', 'numeric'],
            'ticket' => ['required', 'max:14'],
            ];
    }
    
    public function render()
    {
        return view('livewire.inventory.measurement.content');
    }

    public function updated($propertyName)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->validateOnly($propertyName);
    }
    
    public function updatedBarcode()
    {
        $this->barcode = Str::substr($this->barcode, 0, 14);
        $this->invSessionTicket = InventorySessionTicket::where('ticket', $this->barcode)->first();
        if(!$this->invSessionTicket){
            $this->addError('barcode', 'Il Barcode NON è valido!');
            return;
        }
        $this->invSessionWarehouse = $this->invSessionTicket->inventorySessionWarehouse;
        $this->invSession = $this->invSessionWarehouse->inventorySession;
        $this->invMeasurements = $this->invSessionTicket->inventoryMeasurement;
        
        $this->inventory_session_id = $this->invSession->id;
        $this->inventory_session_warehouse_id = $this->invSessionWarehouse->id;
        $this->inventory_ticket_id = $this->invSessionTicket->id;
        $this->warehouse_id = $this->invSessionWarehouse->warehouse->id;

        $this->codMag = $this->invSessionWarehouse->warehouse->code;
        $this->year = $this->invSession->year;
        $this->month = $this->invSession->month;
        $this->periodo = $this->month .'/'. $this->year;
        
        if($this->invMeasurements) {
            $this->addError('barcode', 'Cartellino già Inventariato!');
            $this->product = $this->invMeasurements->product;
            $this->codProd = $this->invMeasurements->product->code;
            $this->product_id = $this->invMeasurements->product->id;
            $this->descrProd = $this->invMeasurements->product->description;
            $this->umProd = $this->invMeasurements->product->unit;
            $this->codUbi = $this->invMeasurements->ubication->code;
            $this->ubic_id = $this->invMeasurements->ubication->id;
            $this->qty = $this->invMeasurements->qty;
        }
        $this->ticket = $this->barcode;
    }

    public function updatedCodProd()
    {
        $this->product = Product::where('code', $this->codProd)->first();
        if (!$this->product) {
            $this->addError('codProd', 'Il Prodotto NON è valido!');
            return;
        }
        $this->product_id = $this->product->id;
        $this->descrProd = $this->product->description;
        $this->umProd = $this->product->unit;
    }
    
    public function updatedCodUbi()
    {
        $this->ubication = Ubication::where('code', $this->codUbi)->first();
        if (!$this->ubication) {
            $this->addError('codUbi', 'L\'Ubicazione NON è valida!');
            return;
        }
        
        $this->ubic_id = $this->ubication->id;
    }

    public function save(){
        $validatedData = $this->validate();
        InventoryMeasurement::create($validatedData);
        $this->reset();
    }

    public function resetInv(){
        $this->reset();
    }

}
