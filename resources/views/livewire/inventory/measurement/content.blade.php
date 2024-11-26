<x-layouts.dynamic-content collapsed='{{ $collapsed }}'>
    <x-slot:content>

        <div class="card">
            
            <div class="card-body">
                <x-adminlte-input name="barcode" label="Barcode Inventariale:" placeholder="Barcode Inventariale" error-key="barcode" wire:model.lazy="barcode"/>
                @if ($invSessionTicket)
                    <div class="row">
                        <x-adminlte-input name="codMag" label="Codice Magazzino:" placeholder="Codice Magazzino" error-key="codMag" wire:model.lazy="codMag" disabled fgroup-class="col-6"/>
                        <x-adminlte-input name="periodo" label="Periodo:" placeholder="Periodo" error-key="periodo" wire:model.lazy="periodo" disabled fgroup-class="col-6"/>
                    </div>

                    <hr>
                    <x-adminlte-input name="codProd" label="Codice Prodotto:" placeholder="Codice Prodotto" error-key="codProd" wire:model.lazy="codProd"/>
                    @if ($product)
                    <x-adminlte-input name="descrProd" label="Descrizione Prodotto:" placeholder="Descrizione Prodotto" error-key="descrProd" wire:model.lazy="descrProd" disabled/>
                    
                    <hr>
                    <x-adminlte-input name="codUbi" label="Codice Ubicazione:" placeholder="Codice Ubicazione" error-key="codUbi" wire:model.lazy="codUbi"/>
                    
                    @if ($ubication)
                    <hr>
                    <x-adminlte-input name="qty" label="Qta Inv:" placeholder="qty" type="number" error-key="qty" wire:model.lazy="qty" class="text-right" min=1 max=100>
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                {{ $umProd }}
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    @endif

                    @endif

                @endif
                
            </div>

        </div>

        <div class="card">        
            <div class="card-body">
                <button type="button" class="btn btn-default btn-block float-left" wire:click="resetInv">Reset</button>
                <br><br>
                @if ($qty)
                    <button type="submit" class="btn btn-primary btn-block" wire:click="save">Salva</button>
                @endif
            </div>
        </div>

    </x-slot:content>

    <x-slot:extraContent>
    </x-slot:extraContent>

</x-layouts.dynamic-content>