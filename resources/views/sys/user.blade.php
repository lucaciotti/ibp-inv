@extends('layouts.app')

@section('title', 'Utenti')

@section('content_header')
<h1>Configurazone Utenti</h1>
@stop

@section('content-fluid')

<livewire:sys.user.content />

@stop

@push('js')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush

@section('plugins.TempusDominusBs4', true)