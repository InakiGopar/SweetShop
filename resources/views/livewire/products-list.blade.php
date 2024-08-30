<div>
    <div class="products-buttons-user">
        <button wire:click="$set('filter', '')">Todos los productos</button>
        <button wire:click="$set('filter', 'productos-dulces')">Productos dulces</button>
        <button wire:click="$set('filter', 'productos-salados')">Productos salados</button>
    </div>

    <div class="list-products">
        <ul>
            @forelse ($products as $product)
                <li>
                    Nombre: {{ $product->name }}
                    Precio: {{ $product->price }}

                    @can('update', $product)
                        <button>
                            <a href="{{ route('product.edit', [ $product ]) }}">Editar</a>
                        </button>
                    @endcan
                    
                    <button>
                        <a href="{{ route('product.show', [$product]) }}">Ver detalle</a>
                    </button>
                    
                    @can('delete', $product)
                        <form action="{{ route('product.delete', [ $product ]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    @endcan
                </li>
            @empty
                <h2>No hay productos para mostrar</h2>
            @endforelse
        </ul>
    </div>
</div>
