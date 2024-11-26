<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">
        <h4 class="modal-title">{{ $title }}</h4>
    </x-slot>

    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->
    <div class="modal-body">

        <div class="row">
            @if($mode=='edit')
                <x-adminlte-select name="year" label="Anno Inventario" error-key="year" wire:model="year" style="text-align: center;" class="text-bold" fgroup-class="col-lg-6" disabled>
                    @foreach ($list_years as $value)
                    <option value='{{ $value }}'><strong>{{ $value }}</strong></option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="month" label="Mese Inventario" error-key="month" wire:model="month" style="text-align: center;" class="text-bold" fgroup-class="col-lg-6" disabled>
                    @foreach ($list_months as $key => $value)
                    <option value='{{ $key }}'><strong>{{ $value }}</strong></option>
                    @endforeach
                </x-adminlte-select>
            @else
                <x-adminlte-select name="year" label="Anno Inventario" error-key="year" wire:model="year" style="text-align: center;" class="text-bold" fgroup-class="col-lg-6">
                    @foreach ($list_years as $value)
                    <option value='{{ $value }}'><strong>{{ $value }}</strong></option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="month" label="Mese Inventario" error-key="month" wire:model="month" style="text-align: center;" class="text-bold" fgroup-class="col-lg-6">
                    @foreach ($list_months as $key => $value)
                    <option value='{{ $key }}'><strong>{{ $value }}</strong></option>
                    @endforeach
                </x-adminlte-select>
            @endif
        </div>
        
        <x-adminlte-input name="description" label="Descrizione" placeholder="Descrizione" error-key="description" wire:model.lazy="description" />

        <div class="row">
            <div class="form-group col-lg-6">
                <label>Data Inizio</label>
                <div class="mb-3 mb-md-0 input-group">
                    <input error-key="date_start" wire:model.lazy="date_start" id="date_start" type="date" class="form-control" />
                </div>
                @error('date_start') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-lg-6">
                <label>Data Fine</label>
                <div class="mb-3 mb-md-0 input-group">
                    <input error-key="date_end" wire:model.lazy="date_end" id="date_end" type="date" class="form-control" />
                </div>
                @error('date_end') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="form-check">
            <input class="form-check-input" id="active" name="active" type="checkbox" wire:model.lazy="active">
            <label class="form-check-label" for="active"><strong>Attivo</strong></label>
            @error('active') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

    </div>

    <x-slot name="buttons">
        <button type="button" class="btn btn-default float-left" wire:click="$emit('modal.close')">Cancella</button>
        <button type="submit" class="btn btn-primary">Salva</button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>