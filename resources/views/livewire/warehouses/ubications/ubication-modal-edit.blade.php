<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">
        <h4 class="modal-title">{{ $title }}</h4>
    </x-slot>

    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->
    <div class="modal-body">

        <x-adminlte-input name="code" label="Codice Ubicazione" placeholder="Codice Ubicazione" error-key="code"
            wire:model.lazy="code" />

        <x-adminlte-input name="description" label="Descrizione" placeholder="Descrizione" error-key="description"
            wire:model.lazy="description" />

    </div>

    <x-slot name="buttons">
        <button type="button" class="btn btn-default float-left" wire:click="$emit('modal.close')">Cancella</button>
        <button type="submit" class="btn btn-primary">Salva</button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>