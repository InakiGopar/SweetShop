
<div class="orders-container"
>
    <div class="btn-order-container">

        <button class="btn btn-primary">
            <a href="{{route('order.create')}}">Quiero Hacer Un Pedido</a>
        </button>
    
        <button class="btn btn-secondary" wire:click="$set('filter', '')">Ver Todos Los Pedidos</button>

        <button class="btn btn-secondary" wire:click="$set('filter', 'mis-pedidos')">Mis Pedidos</button>
    
    </div>

    <ul>
        @forelse ($orders as $order)
            <li>
                <div class="order">
    
                    <div class="pending">                        
                        <span>{{$order->status}}</span>
                    </div>
                    
                    <h4>Pedido de <span class="order-name">{{$order->user->name}}</span></h4>
                    <small class="order-date">{{$order->created_at->format('d/m/Y')}}</small>
                    <p>Cantidad De Productos: {{$order->quantity}}</p>
                    
                    <div class="order-buttons-container">
                        <button class="btn btn-primary">
                            <a href="{{route('order.show', [$order])}}">Ver detalle </a>
                        </button>
        
                        @can('update', $order)
                            <button class="btn btn-secondary">
                                <a href="{{ route('order.edit', [ $order ]) }}">Editar</a>
                            </button>
                        @endcan
        
                        @can('delete', $order)
                            <form action="{{ route('order.delete', [ $order ]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </li>
        @empty
            <h2>No hay pedidos</h2>
        @endforelse
    </ul>
</div>
