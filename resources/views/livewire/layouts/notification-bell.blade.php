<div>
    @if (!$openedSlideOver)
        @if ($notifyLabel['label']>0)
            <x-adminlte-navbar-notification :id="$item['id']" :href="$item['href']" :icon="$item['icon']"
                :badge-label="$notifyLabel['label'] ?? null"
                :badge-color="$notifyLabel['label_color'] ?? null"
                {{-- onclick="Livewire.emit('slide-over.open', 'layouts.notification-slide-over')" /> --}}
                wire:click="openSlideOver" wire:poll.5s.visible="getNotifications" />
        @else
            <x-adminlte-navbar-notification :id="$item['id']" :href="$item['href']" :icon="$item['icon']"
                {{-- onclick="Livewire.emit('slide-over.open', 'layouts.notification-slide-over')" /> --}}
                wire:click="openSlideOver" wire:poll.5s.visible="getNotifications" />
        @endif        
        {{-- :update-cfg="$item['update_cfg'] ?? null"
        :enable-dropdown-mode="$item['dropdown_mode'] ?? null" :dropdown-footer-label="$item['dropdown_flabel'] ?? null" /> --}}
    @else
        <x-adminlte-navbar-notification :id="$item['id']" :href="$item['href']" :icon="$item['icon']"
            :icon-color="$notifyLabel['icon_color'] ?? null"
            {{-- onclick="Livewire.emit('slide-over.close', 'layouts.notification-slide-over')"/> --}}
            wire:click="closeSlideOver" />
    @endif
</div>
