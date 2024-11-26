<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">
        <h4 class="modal-title">{{ $title }}</h4>
    </x-slot>

    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->
    <div class="modal-body">

        <x-adminlte-select name="warehouse_id" label="Magazzino:" error-key="warehouse_id" wire:model="warehouse_id" style="text-align: center;" class="text-bold">
            @foreach ($list_warehouses as $value)
            <option value='{{ $value->id }}'><strong>{{ $value->code }}</strong> - {{ $value->description }}</option>
            @endforeach
        </x-adminlte-select>
        
        <x-adminlte-input name="ticket_printed_old" label="n° Tagliandini già stampati:" placeholder="n° Tagliandini già stampati:" error-key="ticket_printed_old" wire:model.lazy="ticket_printed_old" disabled/>

        <x-adminlte-input name="ticket_to_print" label="n° Tagliandi da Stampare:" placeholder="ticket_to_print" type="number" error-key="ticket_to_print" wire:model.lazy="ticket_to_print" igroup-size="sm" min=1 max=100>
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-hashtag"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

    </div>

    <x-slot name="buttons">
        <button type="button" class="btn btn-default float-left" wire:click="$emit('modal.close')">Cancella</button>
        @if ($invSessionWarehouses)
            <button type="button" class="btn btn-default" onclick="Livewire.emit('slide-over.open', 'audits.audits-slide-over', {'ormClass': '{!! class_basename(get_class($invSessionWarehouses)) !!}', 'ormId': {{ $invSessionWarehouses->id }}});"><i>Ultima Modifica:</i> <span class="fa fa-history pr-1"></span><strong>{{ $invSessionWarehouses->updated_at->format('d-m-Y') }}</strong></button>
        @endif
        <button type="submit" class="btn btn-primary">Genera PDF Tagliandini</button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>