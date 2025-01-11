<div class="notification-container">
    <div 
        class="ic-notification"
        wire:click = 'showPendingOrders'
    >
    </div>
    <div class="notification-amount">
        <span>{{$orders->count()}}</span>
    </div>
    @if ($showOrders)
        <div class="order-pending-list {{ $showOrders ? 'visible' : '' }}">
            @forelse($orders as $order)
                    <ul>
                        <li>
                            <a href="{{route('order.show', [$order])}}">{{$order->user->name}}</a>
                        </li>
                    </ul>
                
                @empty
                <ul>
                    <li>No hay pedidos para mostrar</li>
                </ul>
            @endforelse
    </div>
    @endif
</div>
