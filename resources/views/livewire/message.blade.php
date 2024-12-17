<div>
    @if($message)
        <div 
            class="message"
            style="{{$message === 'Pedido eliminado!' ? 'background-color:#A8292B' : 'background-color:#2E8F23'}}"
        >
            <span> {{ $message }} </span>
            <button wire:click="clearMessage"></button>
        </div>
    @endif
</div>