<x-app-layout>
    <div class="products-container">

        <h1>Nuestros Productos</h1>

        <!--Message to the user informing them if the action they requested was completed-->
        <livewire:message />

        <!--Add Product button (only admin users)-->
        <div class="products-buttons-container-admin">
            @if (auth()->user()->role === 'admin')
                <button class="app-button">
                    <a href="{{route('product.create')}}">Agregar un producto</a>
                </button>
            @endif
        </div> 

        <!-- Livewire component -->
        <livewire:products-list />
    </div>
</x-app-layout>
