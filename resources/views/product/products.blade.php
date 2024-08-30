<x-app-layout>
    <h1>Nuestros Productos</h1>
    <div class="products-container">
        <!--Mensaje al usario que le informa si se completo la accion que solicito-->
        <livewire:message />

        <div class="products-buttons-container-admin">
            @if (auth()->user()->role === 'admin')
                <button>
                    <a href="{{route('product.create')}}">Agregar un producto</a>
                </button>
            @endif
        </div> 

        <!-- Incluye el componente de Livewire para mostrar y filtrar productos -->
        <livewire:products-list />
    </div>
</x-app-layout>
