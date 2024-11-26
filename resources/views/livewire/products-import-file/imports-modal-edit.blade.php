<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">
        <h4 class="modal-title">{{ $title }}</h4>
    </x-slot>

    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->
    <div class="modal-body">

        <div class="form-group">
            <label for="file">Carica Excel</label>
            <input id="file" type="file" class="btn btn-default w-100" wire:model.lazy="file">
            @error('file') <span class="text-danger">{{ $message }}</span> @enderror
            @error('file_extension') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div wire:loading wire:target="file">Uploading...</div>

        <x-adminlte-input name="filename" label="Nome File" placeholder="Nome File" error-key="filename"
            wire:model.lazy="filename" disabled />


    </div>

    <x-slot name="buttons">
        <button type="button" class="btn btn-default float-left" wire:click="$emit('modal.close')">Cancella</button>
        <button type="submit" class="btn btn-primary">Salva</button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>