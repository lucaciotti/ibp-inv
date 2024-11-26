<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">
        <h4 class="modal-title">{{ $title }}</h4>
    </x-slot>

    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->
    <div class="modal-body">

        <x-adminlte-input name="name" label="Nome Utente" placeholder="Nome Utente" error-key="name" wire:model.lazy="name" />

        <x-adminlte-input name="email" label="Email Utente" placeholder="Email Utente" error-key="email" wire:model.lazy="email" />

        <x-adminlte-select name="role_name" label="Ruolo Utente" error-key="role_name"
            wire:model="role_name" style="text-align: center;">
            @foreach ($roles as $role)
            <option value='{{ $role->name }}'><strong>{{ $role->display_name }}</strong></option>
            @endforeach
        </x-adminlte-select>

    </div>

    <x-slot name="buttons">
        <button type="button" class="btn btn-default float-left" wire:click="$emit('modal.close')">Cancella</button>
        <button type="submit" class="btn btn-primary">Salva</button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>