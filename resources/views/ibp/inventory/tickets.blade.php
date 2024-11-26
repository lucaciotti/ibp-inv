@extends('layouts.app')

@section('title', 'Tickets Inv')

@section('content_header')
<h1>Tickets Inventario</h1>
@stop

@section('content-fluid')
{{-- @if ($planType) --}}
<livewire:inventory.tickets.content />
{{-- @endif --}}
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush

@section('plugins.TempusDominusBs4', true)