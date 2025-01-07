
@extends('layouts.details')

@section('content')
<div class="show-product-container">
    <!--Product name-->
    <h2>{{$product->name}}</h2>


    <!--Product image-->
    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Imagen del Producto">
    

    <!--Product info-->
    <div class="info-product">
        <div class="description">
            <p>{{$product->description}}</p>
        </div>

        <div class="line-brown"></div>

        @if (auth()->user()->role === 'admin')
            <div class="ingredients">
                <figure class="ingredients-icon"></figure>
                <p>{{$product->ingredients}}</p>
            </div>
        @endif
    </div>

    <!--Back Button-->
    <button class="app-button">
        <a href="{{route('product.products')}}">Volver</a>
    </button>
</div>
@endsection

