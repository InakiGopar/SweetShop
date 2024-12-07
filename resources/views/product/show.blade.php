
@extends('layouts.details')

@section('content')
<div class="show-product-container">
    <h2>{{$product->name}}</h2>

    <figure class="product-img"></figure>

    <div class="info-product">

        <div class="description">
            <p>{{$product->description}}</p>
        </div>

        <div class="ingredients">
            <figure class="ingredients-icon"></figure>
            <p>{{$product->ingredients}}</p>
        </div>

    </div>
    <button class="btn btn-primary">
        <a href="{{route('product.products')}}">Volver</a>
    </button>
</div>
@endsection

