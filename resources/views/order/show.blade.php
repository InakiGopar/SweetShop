
<!--Mensaje al usario que le informa si se completo la accion que solicito-->
@if (session()->has('message'))
    <div class="message-container">
        <span> {{session('message')}}</span>
    </div>
@endif

<h3>Detalle del Pedido #{{ $order->id }}</h3>
<p>Pedido realizado por {{ $order->user->name }}</p>
<p>Total de productos pedidos: {{ $order->products->sum('pivot.quantity') }}</p>

<ul>
    @foreach($order->products as $product)
        <li> Cantidad: {{ $product->pivot->quantity }} Producto: {{ $product->name }}</li>
    @endforeach
</ul>