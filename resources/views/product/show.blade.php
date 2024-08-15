<div class="show-product-container">
    <h2>{{$product->name}}</h2>
    <div class="info-product">
        <p>Ingredientes: {{$product->ingredients}}</p>
        <p>Descripción: {{$product->description}}</p>
        <p>¿Es dulce?: {{$product->is_sweet ? 'si' : 'no'}}</p>
    </div>
    <button>
        <a href="{{route('product.products')}}">Volver</a>
    </button>
</div>