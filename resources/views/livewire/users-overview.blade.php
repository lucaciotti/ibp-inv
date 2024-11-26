<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">
        <h4 class="modal-title">Large Modal</h4>
    </x-slot>

    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->
    <div class="modal-body">
        <p>One fine body…</p>
        <button class="btn btn-default" wire:click="confirmation()">Confirm</button>
    </div>

    <x-slot name="buttons">
        
            <button type="button" class="btn btn-default" wire:click="$emit('slide-over.close')">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>