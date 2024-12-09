<div class="products-list-container">
    <div class="button-fillters-container">

        <button 
            class="button-secondary"  
            wire:click="$set('filter', '')"
            style= "background-color: {{$filter == '' ? '#5D2B14' : '#8C543A'}}"
        >
            Todos los productos
        </button>

        <button 
            class="button-secondary" 
            wire:click="$set('filter', 'productos-dulces')"
            style="background-color: {{$filter === 'productos-dulces' ? '#5D2B14' : '#8C543A'}}"
        >
            Productos dulces
        </button>

        <button 
            class="button-secondary" 
            wire:click="$set('filter', 'productos-salados')"
            style="background-color: {{$filter === 'productos-salados' ? '#5D2B14' : '#8C543A'}}"
        >
            Productos salados
        </button>
        
    </div>

    <div class="products-list">
        @forelse ($products as $product)
            <div class="card col-4 sm-3" style="width: 18rem;">
                <img src="img/logo.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"> {{ $product->name }}</h5>
                    <p class="card-text"> ${{ $product->price }}</p>

                    <button class="app-button">
                        <a href="{{ route('product.show', [$product]) }}">Ver detalle</a>
                    </button>
                    <div class="buttons-admin-container">
                        @can('update', $product)
                            <button class="app-button">
                                <a href="{{ route('product.edit', [ $product ]) }}">Editar</a>
                            </button>
                        @endcan
                
                        @can('delete', $product)
                            <form action="{{ route('product.delete', [ $product ]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="app-button-danger" type="submit">Eliminar</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
            @empty
                <h2>No hay productos para mostrar</h2>
        @endforelse
    </div>
</div>
