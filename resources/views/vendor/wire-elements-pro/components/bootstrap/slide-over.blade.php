@props(['closeButton' => true, 'onSubmit' => null, 'contentPadding' => true])
<form wire:submit.prevent="{{ $onSubmit }}">
    {{-- <div class="bs-canvas bs-canvas-right position-fixed bg-light">
        <header class="bs-canvas-header p-3 bg-primary overflow-auto">
            <button type="button" class="bs-canvas-close float-left close" aria-label="Close"><span aria-hidden="true"
                    class="text-light">×</span></button>
            <h4 class="d-inline-block text-light mb-0 float-right">Canvas Header</h4>
        </header>
        <div class="bs-canvas-content px-3 py-5">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Quilt</td>
                        <td>2</td>
                        <td class="text-center"><a href="" class="text-decoration-none text-muted">×</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Shawl</td>
                        <td>1</td>
                        <td class="text-center"><a href="" class="text-decoration-none text-muted">×</a></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Pillow</td>
                        <td>5</td>
                        <td class="text-center"><a href="" class="text-decoration-none text-muted">×</a></td>
                    </tr>
                </tbody>
            </table>
            <p class="text-center"><button type="button" class="btn btn-primary">Checkout</button></p>
            <div class="list-group my-5">
                <a href="#" class="list-group-item list-group-item-action">Cras justo odio</a>
                <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
            </div>
            <p class="text-muted small">Subscribe to our newsletter:</p>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Email" aria-label="Username"
                    aria-describedby="addon-wrapping">
            </div>
            <p class="text-right mt-3 mb-0">
                <button type="button" class="btn btn-outline-dark">Subscribe</button>
            </p>
        </div>
    </div> --}}
    <div class="modal-header pt-reduced pb-reduced " style="background: #3c8dbcc3; padding-top: 8px; padding-bottom: 5px">
        @if($title ?? false)
        <h5 class="modal-title">{{ $title }}</h5>
        @endif
        <button type="button" class="close" wire:click="$emit('slide-over.close')" aria-label="Close">
            <span aria-hidden="true"><span class="fa fa-times pt-1" style="color:#505050"></span></span>
        </button>
        
        {{-- <button type="button" wire:click="$emit('slide-over.close')" class="btn-close text-reset" aria-label="Close"></button> --}}
        {{-- @endif --}}
    </div>
    {{-- <div @class(['offcanvas-body', 'px-0 py-0' => !$contentPadding])>
        {{ $slot }}
    </div> --}}
    <div @class(['modal-body' , 'px-0 py-0'=> !$contentPadding])>
        {{ $slot }}
    </div>
    @if($buttons ?? false)
        <div class="offcanvas-body py-0">
            {{ $buttons }}
        </div>
    @endif
</form>

