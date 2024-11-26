@extends('mcslide._exports.pdf._masterPage.masterPdf')

@section('pdf-main')
<style>
    table,
    th,
    td {
        border: 2px solid #090909;
        border-collapse: collapse;
        text-align: center;
        border-style: groove;
        height: 25px;
        vertical-align: middle;
    }
</style>

@php
$firstPage=true;
// $chunkTasks = array_chunk($tasks, 5);
@endphp

{{-- @foreach ($chunkTasks as $tasks)
<p class="page"> --}}
    {{-- @if ($firstPage)
        <div class="row" style="text-align: center">
            <h1>Pianificazione {{ $planName }}</h1>
            <h2>Periodo Produzione: {{ $dtMin }} - {{ $dtMax }}</h2>
            <br>
            <h2 style="text-align: right;"><i><u>Totale Macchine:</u></i> {{ $total_tasks }}</h2>
            <hr>
        </div>
        @php
        $firstPage=false;
        @endphp
    @endif --}}

    @foreach ($ticketsToPrint as $ticket)    

        <div class="row element-that-contains-table" style="padding-top: 5pt;">
            <table style="font-size: medium; font-weight:600;">
                <col width='50%'>
                <col width='20%'>
                <col width='30%'>
                <tr style="height:40px">
                    <th rowspan="2"><?php echo DNS1D::getBarcodeSVG($ticket->ticket, 'C39+', 1.5, 60, 'black', true); ?></th>
                    <th>n° {{ $ticket->num_ticket }}</th>
                    <th>Inventario: {{ $ticket->inventorySessionWarehouse->inventorySession->month }}/{{ $ticket->inventorySessionWarehouse->inventorySession->year }}</th>
                </tr>
                <tr style="height:40px">
                    <th>{{ $ticket->date_printed->format('d/m/Y') }}</th>
                    <th><canvas id="canvas1" width="10" height="10" style="border:3px solid #000000;"></canvas> &nbsp;INVENTARIATO</th>
                </tr>
                <tr style="height:60px">
                    <td colspan="3" style="font-size: large; text-align: left;">
                        Referente Conteggio: &nbsp;&nbsp;____________________________
                    </td>
                </tr>
                <tr style="height:120px">
                    <td style="font-size: large; text-align: left;">Cod. Articolo:<br><br><br>&nbsp; ________________________________________ <br><br></td>
                    <td style="font-size: large;">Qta:<br><br>&nbsp; ____________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>UM: ______<br><br></td>
                    <td>Mag: {{ $ticket->inventorySessionWarehouse->warehouse->code }} <br><br>Ubicazione: <br><br>______________<br><br></td>
                </tr>
            </table>
            
            <div>
                <br>
                <hr class="dividerPage">
                <br>
            </div>
        </div>
        
    @endforeach

{{-- </p>
@endforeach --}}

@endsection