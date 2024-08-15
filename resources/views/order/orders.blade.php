<h1>Pedidos </h1>
<div class="orders-container">

    <!--Mensaje al usario que le informa si se completo la accion que solicito-->
    @if (session()->has('message'))
        <div class="message-container">
            <span> {{session('message')}}</span>
        </div>
    @endif

    <div class="btn-order-container">
        <button>
            <a href="{{route('order.create')}}">Quiero hacer un pedido</a>
        </button>
        <button>
            <a href="{{route('order.orders', ['filtro' => 'mis-pedidos'])}}">Ver mis pedidos</a>
        </button>
    </div>
    <ul>
        @forelse ($orders as $order)
            <li>
                <h4>Pedido de {{$order->user->name}}</h4>
                cantidad de productos: {{$order->quantity}}
                estado del pedido: {{$order->status}}
                <small>{{$order->created_at->format('d/m/Y')}}</small>
                <button>
                    <a href="{{route('order.show', [$order])}}">Ver detalle </a>
                </button>

                @can('update', $order)
                    <button>
                        <a href="{{ route('order.edit', [ $order ]) }}">Editar</a>
                    </button>
                @endcan

                @can('delete', $order)
                    <form action="{{ route('order.delete', [ $order ]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                @endcan

            </li>
        @empty
            <h2>No hay pedidos</h2>
        @endforelse
    </ul>
</div>