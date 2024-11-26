<x-layouts.dynamic-content collapsed='{{ $collapsed }}'>
    <x-slot:content>

        <div class="card">
            
            <div class="card-body">
                
                @if (!$product)
                    @if(!$isToogleSearch)
                        <x-adminlte-input name="codProd" label="Codice Prodotto:" placeholder="Codice Prodotto" error-key="codProd" wire:model.lazy="codProd">
                            <x-slot name="appendSlot">
                                <button class="btn btn-sm btn-outline-primary" type="button" wire:click="toogleSearch" data-toggle="tooltip"
                                    data-placement="bottom" title="Ricerca Libera">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                            </x-slot>
                        </x-adminlte-input>
                    @else
                        <x-adminlte-input name="search" label="Ricerca Libera:" placeholder="Ricerca Libera" error-key="search" wire:model="search">
                            <x-slot name="appendSlot">
                                <button class="btn btn-sm btn-outline-primary" type="button" wire:click="toogleSearch" data-toggle="tooltip"
                                    data-placement="bottom" title="Codice Prodotto">
                                    <i class="fas fa-fw fa-barcode"></i>
                                </button>
                            </x-slot>
                        </x-adminlte-input>
                        @if(!empty($listProds))
                        <div id='dropdownList' class="navbar-search-results myDropdownDiv">
                            <div class="list-group myDropdownList">
                                <a href="#" class="list-group-item list-group-item-action" wire:loading wire:target="search">
                                    <div class="d-flex align-items-center text-secondary">
                                        <strong>Caricamento...</strong>
                                        <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                    </div>
                                </a>
                                @if(!empty($listProds))
                                @foreach($listProds as $i => $product)
                        
                                <a class="list-group-item list-group-item-action" wire:click="selectedProd('{{ $product['code'] }}')">
                                    <div class="d-flex w-100 justify-content-between">
                                        <p class="mb-1"><b>{{ $product['code'] }}</b><br><small>{{ $product['description'] }}</small></p>
                                    </div>
                                </a>
                        
                                @endforeach
                                @else
                                <a class="list-group-item">
                                    <div class="search-title">Nessun risultato...
                                    </div>
                                    <div class="search-path"></div>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endif
                @else
                    <x-adminlte-input name="codProd" label="Codice Prodotto:" placeholder="Codice Prodotto" error-key="codProd" wire:model.lazy="codProd" disabled/>
                    <x-adminlte-input name="descrProd" label="Descrizione Prodotto:" placeholder="Descrizione Prodotto"
                        error-key="descrProd" wire:model.lazy="descrProd" disabled />
                    
                    <hr>
                    <x-adminlte-input name="codUbi" label="Codice Ubicazione:" placeholder="Codice Ubicazione" error-key="codUbi"
                        wire:model.lazy="codUbi" />
                    
                    <hr>
                    <x-adminlte-input name="qty" label="Qta Inv:" placeholder="qty" type="number" error-key="qty" wire:model.lazy="qty" inputmode="numeric"
                        class="text-left" min=1 >
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-dark">
                                {{ $umProd }}
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                @endif
                
            </div>

        </div>

        <div class="card">        
            <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-block" wire:click="save">Salva</button>
                
            </div>
        </div>

    </x-slot:content>

    <x-slot:extraContent>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <button type="button" class="btn btn-default btn-block float-left" wire:click="resetInv">Reset</button>
            </div>
        </div>
        
    </x-slot:extraContent>

</x-layouts.dynamic-content>

@push('css')
<style>
    .myDropdownList {
        max-height: 400px;
        margin-bottom: 5px;
        /* overflow-y: scroll; */
        -webkit-overflow-scrolling: touch;
    }

    .myDropdownDiv {
        position: absolute;
        width: 96%;
        overflow-y: auto;
        /* padding-top: 5px; */
        margin-top: -12px;
        z-index: 10;
        /* background: white; */
        /* border-bottom-left-radius: 10px; */
        /* border-bottom-right-radius: 10px; */
        /* max-height: 200px; */
        /* border: 1px solid gray; */
        /*This is relative to the navbar now*/
        /* left: 0;
            right: 0;
            top: 40px; */
    }

    @media screen and (max-width: 500px) {
        .myDropdownDiv {
            width: auto;
            margin-left: -15px;
        }
    }

    .myDropdownDiv a:link,
    a:visited,
    a:hover,
    a:active {
        color: #000;
    }

    .myDropdownDiv a:hover,
    a:active {
        background-color: lightblue;
        cursor: pointer;
    }
</style>
@endpush