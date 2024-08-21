<x-app-layout>
    <h1>Nuestros Productos</h1>
    <div class="products-container">
        <!--Mensaje al usario que le informa si se completo la accion que solicito-->
        @if (session()->has('message'))
            <div class="message-container">
                <span> {{session('message')}}</span>
            </div>
        @endif

        <div class="products-buttons-container">

            @if (auth()->user()->role === 'admin')
                <button>
                    <a href="{{route('product.create')}}">Agregar un producto</a>
                </button>
            @endif

            <button>
                <a href="{{route('product.products', ['filtro' => 'productos-dulces'])}}">Productos dulces</a>
            </button>
            <button>
                <a href="{{route('product.products', ['filtro' => 'productos-salados'])}}">Productos salados</a>
            </button>
        </div> 
        <div class="list-products">
            <ul>
                @forelse ($products as $product)
                <li>
                    Nombre: {{$product->name}}
                    Precio: {{$product->price}}

                    @can('update', $product)
                        <button>
                            <a href="{{ route('product.edit', [ $product ]) }}">Editar</a>
                        </button>
                    @endcan
                    
                    <button>
                        <a href="{{route('product.show', [$product])}}">Ver detalle</a>
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
</x-app-layout>
