<form class="row g-3" method="POST" 
  action="{{empty($order) ? route('order.store') : route('order.update', $order)}}"
>

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

    @foreach($products as $product)
        <div>
            <label for="product_{{ $product->id }}">{{ $product->name }}</label>
            <input type="number" name="products[{{ $product->id }}]" id="product_{{ $product->id }}" min="0"
              value="{{empty($order) ? '0' :  $order->products->find($product->id)->pivot->quantity ?? '0'}}"
            >
        </div>
    @endforeach


    @if (!empty($order))
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Estado del pedido</label>
        <input type="text" class="form-control"
          id="status" name="status"
          value="{{$order->status}}"
        >
      </div>
    @endif

    <div class="form-button-container">
        <button type="submit" class="btn btn-primary">
          {{empty($order) ? 'Hacer pedido' : 'Editar pedido'}}
        </button>
        <button>
          <a href="{{route('order.orders')}}">
            Cancelar
          </a>
        </button>
    </div>
  </form>