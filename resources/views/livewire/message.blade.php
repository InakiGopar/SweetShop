<div>
    @if($message)
        <div class="alert alert-info">
            <span> {{ $message }} </span>
            <button wire:click="clearMessage">Cerrar</button>
        </div>
    @endif
</div>