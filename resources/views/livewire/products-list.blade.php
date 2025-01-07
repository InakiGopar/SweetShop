<div class="products-list-container">
    <div class="button-fillters-container">

        <!--Show all products button-->
        <button 
            class="button-secondary"  
            wire:click="showAll"
            style= "background-color: {{$filter === '' ? '#5D2B14' : '#8C543A'}}"
        >
            Todos los productos
        </button>

        <!--Sweet products filter button-->
        <button 
            class="button-secondary" 
            wire:click="$set('filter', 'productos-dulces')"
            style="background-color: {{$filter === 'productos-dulces' ? '#5D2B14' : '#8C543A'}}"
        >
            Productos dulces
        </button>

        <!--Salty products filter button-->
        <button 
            class="button-secondary" 
            wire:click="$set('filter', 'productos-salados')"
            style="background-color: {{$filter === 'productos-salados' ? '#5D2B14' : '#8C543A'}}"
        >
            Productos salados
        </button>
        
    </div>

    <!--Search-->
    <div class="search-container">
        <div class="search-icon"></div>
        <input 
            type="text" 
            class="search-input" 
            placeholder="Buscar producto..." 
            wire:model.lazy="productSearch"
        >
    </div>

    <!--List of products-->
    <div class="products-list">
        @forelse ($products as $product)
            <div class="card col-4 sm-3" style="width: 18rem;">
                <img class="img-product" src="{{ asset('storage/' . $product->image_path) }}" alt="Imagen del Producto">
                <div class="card-body">
                    <h5 class="card-title"> {{ $product->name }}</h5>
                    <p class="card-text"> ${{ $product->price }}</p>

                    <button class="icon-button more-info">
                        <a href="{{ route('product.show', [$product]) }}">
                            <img src="{{url('img/icons/ic_eye.png')}}" alt="More Info">
                        </a>
                    </button>

                    @can('update', $product)
                        <button class="icon-button edit">
                            <a href="{{ route('product.edit', [ $product ]) }}">
                                <img src="{{url('img/icons/ic_edit.png')}}" alt="Edit">
                            </a>
                        </button>
                    @endcan
                
                    @can('delete', $product)
                        <form action="{{ route('product.delete', [ $product ]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="icon-button delete" type="submit">
                                <img src="{{url('img/icons/ic_delete.png')}}" alt="Delete">
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
            @empty
                <h2>No hay productos para mostrar</h2>
        @endforelse
    </div>
</div>
