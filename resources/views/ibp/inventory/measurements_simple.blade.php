@extends('layouts.app')

@section('title', 'Inventario')

{{-- @section('content_header')
<h1>Misurazioni Inventariali <i>@if($invSession) [{{ $invSession->month }}/{{ $invSession->year }}] @endif </i> </h1>
@stop --}}
@section('content_header_title')
Misurazioni Inventariali
@stop
@section('content_header_subtitle')
<i>@if($invSession) [{{ $invSession->month }}/{{ $invSession->year }}] @endif </i>
@stop


@section('content-fluid')
@if ($invSession)
<livewire:inventory.measuresimple.content />
@else
<div class="card">

    <div class="card-body">
        
        <h3 class='text-danger'>Attenzione!</h3>
        <h4>Nessuna Sessione Inventariale attualmente attiva</h4>

    </div>

</div>
@endif
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
<script>
    document.addEventListener('livewire:load', () => { window.livewire.on('initfocus', inputname => { document.getElementById("codProd").focus(); }) }); 
</script>
@endpush

@section('plugins.TempusDominusBs4', true)