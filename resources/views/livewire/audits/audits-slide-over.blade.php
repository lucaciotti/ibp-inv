<x-wire-elements-pro::bootstrap.slide-over>
    <x-slot name="title">Log Modifiche</x-slot>
    {{-- <span wire:poll.visible="getNotificationsList"></span> --}}
    @php
        $labelHelper = new LabelHelper;
    @endphp
    <div class="list-group">
        @foreach ($logs as $log)
            @php
                $skip = false;
                if($log->event=='updated'){
                    foreach ($log->new_values as $key => $value) {
                        if(stripos($key, 'data')){
                            $old_val = $log->old_values[$key];
                            $new_val = (new Carbon\Carbon(date('d-m-Y',strtotime($value))))->format('d-m-Y');
                            $old_val = (!empty($old_val)) ? (new Carbon\Carbon(date('d-m-Y',strtotime($old_val))))->format('d-m-Y') : $old_val;
                            if ($new_val == $old_val){
                                $skip = true;
                            } else {
                                $skip = false;
                            }
                        } else {
                            $skip = false;
                        }
                    }
                }
            @endphp
            @if (!$skip)
            <div class="list-group-item list-group-item-action">
                <div class="media">
                    @if ($log->event=='created')
                    <span class="fa-stack mr-3 text-success">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                    </span>
                    @endif
            
                    @if ($log->event=='updated')
                    <span class="fa-stack mr-3 text-warning">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                    </span>
                    @endif
            
                    @php
                    $message = ($log->event=='created') ? 'Oggetto Creato' : 'Oggetto Modificato';
                    // dd($log);
                    @endphp
            
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{ $message }} 
                            <em>
                                <small> 
                                    - da: 
                                    @if ($log->user)
                                        <strong>{{ $log->user->name ?? 'Import XLS' }}</strong>
                                    @else
                                        Import XLS
                                    @endif 
                                </small>
                            </em>
                            {{-- <a href="#" class="float-right text-sm text-secondary" wire:click="">
                                <i class="fa fa-check fa-lg"></i></a> --}}
                        </h3>
                        @if ($log->event=='updated')
                            <p class="text-sm mb-0">
                                {{-- Vecchi Valori: <br> --}}
                                @foreach ($log->new_values as $key => $value)
                                    @php
                                        $new_val = $value;
                                        $old_val = $log->old_values[$key];
                                        if (preg_match("/^(?:[1-9]\d{3}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1\d|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[1-9]\d(?:0[48]|[2468][048]|[13579][26])|(?:[2468][048]|[13579][26])00)-02-29)T(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d(?:Z|[+-][01]\d:[0-5]\d)?.\d+Z$/",$new_val)) {
                                            $new_val = (new Carbon\Carbon(date('d-m-Y',strtotime($new_val))))->format('d-m-Y');
                                            $old_val = (!empty($old_val)) ? (new Carbon\Carbon(date('d-m-Y',strtotime($old_val))))->format('d-m-Y') : $old_val;
                                        }
                                    @endphp
                                    @if ($new_val!=$old_val)
                                        <strong>{{ $labelHelper->getLabel($key) }} : </strong> {{ $old_val ?? 'None' }} => {{ $new_val }}<br>
                                    @endif
                                @endforeach
                            </p>
                        @endif
                        <p class="text-sm text-muted float-right pb-0 mb-0"><i class="far fa-clock mr-1"></i>{{
                            $log->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            
            </div>
            @endif
        @endforeach
        
        {{-- <a href="#" class="list-group-item list-group-item-action py-2" style="background: #F0F0F0;" wire:click="markAllAsRead()"><p class="text-sm m-0 text-bold"><em>Segna tutte come lette</em></p></a>     --}}
    </div>

    <style>    
        .wep-slide-over {
            bottom: 0;
            left: 0;
            overflow: hidden;
            position: fixed;
            right: 0;
            top: 0;
            z-index: 42
        }
    
        .wep-slide-over.wep-slide-over-top {
            z-index: 43
        }
    
        .wep-slide-over-container-inner-content {
            padding-top: 0rem;
        }
    </style>
    
</x-wire-elements-pro::bootstrap.slide-over>