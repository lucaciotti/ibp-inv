@extends('layouts.app')

@section('title', 'Ubicazioni')

@section('content_header')
<h1>Lista Ubicazioni</h1>
<h6>Magazzino: <strong>{{ $warehouse->code }}</strong></h6>
@stop

@section('content-fluid')
{{-- @if ($planType) --}}
<livewire:warehouses.ubications.content warehouse_id='{{ $warehouse->id }}' />
{{-- @endif --}}
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush

@section('plugins.TempusDominusBs4', true)