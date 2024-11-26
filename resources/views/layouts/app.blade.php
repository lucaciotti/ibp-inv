{{-- Extends the AdminLTE page layout  --}}
@extends('adminlte::page')


{{-- Browser Title --}}
@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle') | @yield('subtitle') @endif
@stop

{{-- Page Content Header --}}
@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-lightblue">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Page Content Body --}}
@section('content')
    @yield('content_body')
@stop

{{-- Page Footer --}}
@section('footer')
    <div class="float-right d-none d-sm-block">
        {{-- Version number here --}}
    </div>

    <strong>
       {{-- Company name here --}}
    </strong>
@stop

{{-- Extra common CSS --}}
@push('css')
    @vite(['resources/js/app.js'])
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('vendor/wire-elements-pro/css/bootstrap-overlay-component.css') }}">
    <style>
        .main-header {z-index: 38;}
        .main-sidebar {z-index: 38;}
        .control-sidebar{z-index: 37;}
        #sidebar-overlay {z-index: 37;}
        .brand-link.text-sm .brand-image, .text-sm .brand-link .brand-image { margin-left:0rem}
        .brand-link {padding: .8125rem .5rem .3rem .3rem;}
        a.nav-link i { margin: 0.2rem;}
        .table td, .table th {padding: 0rem;padding-left: 0.75rem;padding-top: 0.2rem;padding-bottom: 0.2rem;vertical-align: unset;}
        .card-fullscreen {display: block;z-index: 39;position: fixed;width: 100%;height: 100%;top: 0;right: 0;left: 0;bottom: 0;overflow: auto;}
        .wep-slide-over{bottom:0;left:0;overflow:hidden;position:fixed;right:0;top:0;z-index:36}
        .wep-slide-over.wep-slide-over-top{z-index:37}
        .wep-slide-over-container-inner-content {padding-top: 2.8rem;}
        .fixed_column {
        position: -webkit-sticky; /* for Safari */
        position: sticky;
        left: 0;
        }
        .fixed_column.is-pinned {
        background: white;
        }
        /* .modal-body {
            max-height: calc(100vh - 210px); overflow-y: auto;
        } */
    </style>
@endpush

@push('js')
    <script src="{{ asset('vendor/wire-elements-pro/js/overlay-component.js') }}"></script>
    <script>
        $(document).ready(function () {
        //Toggle fullscreen
        $("#card-fullscreen").click(function (e) {
            e.preventDefault();
            
            var $this = $(this);
            
            if ($this.children('i').hasClass('fa-expand-alt'))
            {
            $this.children('i').removeClass('fa-expand-alt');
            $this.children('i').addClass('fa-compress-alt');
            }
            else if ($this.children('i').hasClass('fa-compress-alt'))
            {
            $this.children('i').removeClass('fa-compress-alt');
            $this.children('i').addClass('fa-expand-alt');
            }
            $(this).closest('.card').toggleClass('card-fullscreen');
        });
        //Toggle Card Text Size
        $("#card-text-size").click(function (e) {
            e.preventDefault();
            
            var $this = $(this);
            
            if ($this.children('i').hasClass('fa-xs'))
            {
            $this.children('i').removeClass('fa-xs');
            $this.prop('title', 'Font Size Bigger');
            $("#card-text-size").closest('.card').children('.card-body').css('font-size', 'smaller');
            }
            else if (!$this.children('i').hasClass('fa-xs'))
            {
            $this.prop('title', 'Font Size Smaller');
            $this.children('i').addClass('fa-xs');
            $("#card-text-size").closest('.card').children('.card-body').removeAttr("style");
            }
        });

        });
    </script>
@endpush
