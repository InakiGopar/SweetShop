
@extends('layouts.details')

@section('content')
<div class="show-product-container">
    <h2>{{$product->name}}</h2>

    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Imagen del Producto">

    <div class="info-product">

        <div class="description">
            <p>{{$product->description}}</p>
        </div>

        <div class="ingredients">
            <figure class="ingredients-icon"></figure>
            <p>{{$product->ingredients}}</p>
        </div>

    </div>
    <button class="app-button">
        <a href="{{route('product.products')}}">Volver</a>
    </button>
</div>
@endsection

