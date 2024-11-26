<?php

namespace App\Http\Livewire\Inventory\Measuresimple;

use App\Http\Livewire\Layouts\DynamicContent;
use App\Models\InventoryMeasurement;
use App\Models\InventorySession;
use App\Models\InventorySessionTicket;
use App\Models\InventorySimple;
use App\Models\Product;
use App\Models\Ubication;
use Carbon\Carbon;
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

    public $isToogleSearch = false;
    public $search = '';
    public $listProds = [];
    
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
            'product_id' => ['required', 'numeric'],
            'ubication' => ['nullable', 'string'],
            'qty' => ['required', 'numeric'],
            'inventory_session_id' => ['required', 'numeric'],
            ];
    }

    public function mount()
    {
        $invSession = InventorySession::where('date_start', '<', Carbon::now())->where('date_end', '>', Carbon::now())->where('active', true)->first();
        if (!$invSession) {
            $invSession = InventorySession::where('date_start', '<', Carbon::now())->where('active', true)->first();
        }
        $this->inventory_session_id = $invSession->id;
    }
    
    public function render()
    {
        return view('livewire.inventory.measuresimple.content');
    }

    public function updated($propertyName)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->validateOnly($propertyName);
    }

    public function updatedCodProd()
    {
        $this->product = Product::where('code', $this->codProd)->orWhere('barcode', $this->codProd)->get();
        if ($this->product->count()!=1) {
            $this->addError('codProd', 'Il Prodotto NON è valido!');
            return;
        }
        $this->product_id = $this->product->id;
        $this->codProd = $this->product->code;
        $this->descrProd = $this->product->description;
        $this->umProd = $this->product->unit;
    }
    
    public function updatedCodUbi()
    {
        // $this->ubication = Ubication::where('code', $this->codUbi)->first();
        // if (!$this->ubication) {
        //     $this->addError('codUbi', 'L\'Ubicazione NON è valida!');
        //     return;
        // }
        
        // $this->ubic_id = $this->ubication->id;
    }

    public function toogleSearch()
    {
        $this->reset(['product', 'codProd', 'search', 'listProds']);
        $this->isToogleSearch = !$this->isToogleSearch;
    }

    public function updatedSearch()
    {
        if (strlen($this->search) < 3) {
            $this->reset(['product']);
            return;
        }
        $this->searchListArt();
    }

    public function searchListArt()
    {
        $this->listProds = Product::where('code', 'like', $this->search . '%')
            ->orWhere('description', 'like', $this->search . '%')
            ->orWhere('barcode', 'like', $this->search . '%')
            ->get()->toArray();
    }

    public function selectedProd($code){
        $this->product = Product::where('code', $code)->first();
        if (!$this->product) {
            $this->addError('codProd', 'Il Prodotto NON è valido!');
            return;
        }
        $this->product_id = $this->product->id;
        $this->codProd = $this->product->code;
        $this->descrProd = $this->product->description;
        $this->umProd = $this->product->unit;
    }

    public function save(){
        $validatedData = $this->validate();
        InventorySimple::create($validatedData);
        $this->reset();
    }

    public function resetInv(){
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
