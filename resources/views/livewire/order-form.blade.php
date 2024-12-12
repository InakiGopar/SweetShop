
<form method="POST" action="{{empty($order) ? route('order.store') : route('order.update', $order)}}">

    @csrf
    @if (empty($order))
        @method('post')
    @else
        @method('put')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="order-products-title">¿Que vas a Pedir hoy?</h2>
    
    @foreach($products as $product)
        <div class="order-products">
            <label for="product_{{ $product->id }}">{{ $product->name }}</label>
            <div class="input-container">
                <input 
                    type="number" 
                    name="products[{{ $product->id }}]"
                    id="product_{{ $product->id }}" 
                    min="0"
                    wire:model="quantities.{{ $product->id }}"
                    wire:change="calculateTotal"
                >
            @if (in_array($product->name, ['Bizcochitos de grasa', 'Pepas', 'Marineras']))
                <span class="info-icon" title="Se vende por cuarto!! 1 equivale a un cuarto del producto"></span>
            @endif
            </div>
        </div>
    @endforeach


    @if (!empty($order))
        <div class="order-state">
            <label for="inputEmail4" class="form-label">Estado del pedido</label>
            <input type="text" class="form-control"  id="status" name="status"  value="{{$order->status}}">
        </div>
    @endif

    <div class="total">
        <strong>Total: ${{ number_format($total, 2) }}</strong>
    </div>

    <div class="form-button-container-order">
        <button type="submit" class="app-button">
            {{empty($order) ? 'Hacer pedido' : 'Editar pedido'}}
        </button>
        <button class="app-button-danger">
            <a href="{{route('order.orders')}}">
                Cancelar
            </a>
        </button>
    </div>
</form>
