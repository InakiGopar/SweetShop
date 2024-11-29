<x-app-layout>
    <div class="home-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="presentation">
                <h2> Hola {{ Auth::user()->name }}! </h2>
                <p>
                    Bienvenido a nuestra pagina web, aqui encontraras todos nuestros  <a href="{{route('product.products')}}">productos</a> y podras hacer
                    tus <a href="{{route('order.orders')}}">pedidos</a>!!
                </p>
                <livewire:carousel />
            </div>
        </div>
    </div>
</x-app-layout>
