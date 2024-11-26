<x-layouts.dynamic-content collapsed='{{ $collapsed }}'>
    <x-slot:content>

        {{-- <div class="card">
            <div class="card-body">
                <div style="">
                    <x-adminlte-select name="plantype_id" label="Tipo di Pianificazione" error-key="plantype_id"
                        wire:model="plantype_id" style="text-align: center;" class="text-bold">
                        @foreach ($plantypes as $plantype)
                        <option value='{{ $plantype->id }}'><strong>{{ $plantype->name }}</strong> - {{
                            $plantype->description }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista sessioni invetario</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" title="Font Size Smaller" id="card-text-size">
                        <i class="fas fa-text-height fa-xs"></i>
                    </button>
                    <button type="button" class="btn btn-tool" title="Toggle fullscreen" id="card-fullscreen">
                        <i class="fas fa-expand-alt"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                {{-- @if ($refresh_table)
                <div class="text-danger text-bold text-center pt-2 pb-2"
                    style="background-color: lightgrey; font-size:medium;">
                    Attenzione: Nuove Pianificazioni Importate!
                    <br>
                    <button class="btn btn-sm btn-outline-danger"
                        onclick="Livewire.dispatch('refreshDatatable');">Aggiorna
                        la tabella</button>
                </div>
                @endif --}}
                <div style="">
                    <livewire:inventory.tickets.inv-sessions-table />
                </div>
            </div>
        </div>
    </x-slot:content>

    <x-slot:extraContent>
        {{-- <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <button class="btn btn-outline-success btn-block"
                    onclick="Livewire.emit('modal.open', 'pdf-reports.generate-reports')">
                    <span class="fa fa-print"></span> Genera PDF Tagliandini
                </button>
            </div>
        </div> --}}
    </x-slot:extraContent>

</x-layouts.dynamic-content>