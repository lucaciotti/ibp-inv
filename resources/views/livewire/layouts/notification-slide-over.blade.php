<x-wire-elements-pro::bootstrap.slide-over>
    <x-slot name="title">Lista Notifiche</x-slot>
    <span wire:poll.2s.visible="getNotificationsList"></span>

    @if ($unreadNotification)
    <h5>Non Lette</h5>
    <div class="list-group">
        @foreach ($unreadNotification as $notification)
        <div class="list-group-item list-group-item-action">
            <div class="media">
                @switch($notification['level'])
                @case('info')
                <span class="fa-stack mr-3 text-info">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                </span>
                @break
                @case('success')
                <span class="fa-stack mr-3 text-success">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                </span>
                @break
                @case('danger')
                <span class="fa-stack mr-3 text-danger">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                </span>
                @break
                @case('error')
                <span class="fa-stack mr-3 text-danger">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                </span>
                @break
                @case('warning')
                <span class="fa-stack mr-3 text-warning">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-exclamation-triangle fa-stack-1x fa-inverse"></i>
                </span>
                @break
                @default
                <span class="fa-stack mr-3 text-secondary">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                </span>
                @endswitch
    
                {{-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                        {{ $notification['title'] }}
                        <a href="#" class="float-right text-sm text-secondary" wire:click="delete('{{$notification['id']}}')"><i
                                class="fa fa-trash"></i></a>
                    </h3>
                    <p class="text-sm mb-0">{{ $notification['body'] }}</p>
                    <p class="text-sm text-muted float-right pb-0 mb-0"><i class="far fa-clock mr-1"></i>{{
                        $notification['date_readable'] }}</p>
                </div>
            </div>
    
        </div>
        @endforeach
        <a href="#" class="list-group-item list-group-item-action py-2" style="background: #F0F0F0;" wire:click="deleteAllReaded()"><p class="text-sm m-0 text-bold"><em>Cancella Notifiche</em></p></a>    
    </div>
    
    <hr class="my-2">    
    @endif

    @if ($readedNotification)
    <h5>Lette</h5>
    <div class="list-group">
        @foreach ($readedNotification as $notification)
            <div class="list-group-item list-group-item-action">
                <div class="media">
                    @switch($notification['level'])
                    @case('info')
                    <span class="fa-stack mr-3 text-info">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                    </span>
                    @break
                    @case('success')
                    <span class="fa-stack mr-3 text-success">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                    </span>
                    @break
                    @case('danger')
                    <span class="fa-stack mr-3 text-danger">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                    @break
                    @case('error')
                    <span class="fa-stack mr-3 text-danger">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                    @break
                    @case('warning')
                    <span class="fa-stack mr-3 text-warning">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-exclamation-triangle fa-stack-1x fa-inverse"></i>
                    </span>
                    @break
                    @default
                    <span class="fa-stack mr-3 text-secondary">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                    </span>
                    @endswitch
        
                    {{-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{ $notification['title'] }}
                            <a href="#" class="float-right text-sm text-secondary"
                                wire:click="delete('{{$notification['id']}}')"><i class="fa fa-trash"></i></a>
                        </h3>
                        <p class="text-sm mb-0">{{ $notification['body'] }}</p>
                        <p class="text-sm text-muted float-right pb-0 mb-0"><i class="far fa-clock mr-1"></i>{{
                            $notification['date_readable'] }}</p>
                    </div>
                </div>    
            </div>
        @endforeach
        <a href="#" class="list-group-item list-group-item-action py-2" style="background: #F0F0F0;" wire:click="deleteAllReaded()"><p class="text-sm m-0 text-bold"><em>Cancella Notifiche</em></p></a>
    </div>
    @endif
</x-wire-elements-pro::bootstrap.slide-over>
