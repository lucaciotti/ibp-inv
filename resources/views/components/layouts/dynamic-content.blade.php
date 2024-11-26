<div class="row justify-content-center">
    @if ($attributes->get('collapsed')==1)
    <div class="col-lg-11">
    @else
    <div class="col-lg-10">
    @endif
        {{ $content }}
    </div>

    @if ($attributes->get('collapsed')==1)
    <div class="col-lg-0">
        <div class="card">
            <div class="card-header">
                <a type="button"
                    class="btn btn-tool text-secondary d-flex justify-content-between align-items-center py-2"
                    onclick="Livewire.emit('dynamic-content.expande')">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-2 ">
        <div class="card">
            <div class="card-header">
                <a type="button"
                    class="btn btn-tool text-secondary d-flex justify-content-between align-items-center py-2"
                    onclick="Livewire.emit('dynamic-content.collapse')">
                    <i class="fas fa-arrow-right"></i>
                    <h3 class="card-title">Nascondi</h3>
                </a>
            </div>
        </div>
        {{ $extraContent }}
    </div>
    @endif

    {{ $slot }}
</div>