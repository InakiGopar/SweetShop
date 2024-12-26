

@extends('layouts.form')


@section('content')
    <form class="row g-3" method="POST" enctype="multipart/form-data"
        action="{{empty($product) ? route('product.store') : route('product.update', $product)}}"
    >
    @csrf

    @if (empty($product))
        @method('post')
    @else
        @method('put')
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="form-group">
            <label for="name">Nombre del Producto</label>
            <input 
                type="text"
                class="form-control"  
                id="name" name="name" 
                value="{{empty($product) ? old('name') : $product->name}}"
            >
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input 
                type="number" 
                class="form-control" id="price" name="price" 
                value="{{empty($product) ? old('price') : $product->price}}"
            >
        </div>
        <div class="form-group">
            <label for="ingredients">Ingredientes</label>
            <input
                type="text"
                class="form-control" id="ingredients" name="ingredients" 
                value="{{empty($product) ? old('ingredients') : $product->ingredients}}"
            >
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" >
                {{empty($product) ? old('description') : $product->description}}
            </textarea>
        </div>
        <div class="form-group">
            <label for="image">Subir Imagen:</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div class="form-group">
            <label>¿Es dulce?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_sweet" id="is_sweet_yes" value="1" >
                <label class="form-check-label" for="is_sweet_yes">
                Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_sweet" id="is_sweet_no" value="0" >
                <label class="form-check-label" for="is_sweet_no">
                No
                </label>
            </div>
        </div>
        <div class="form-button-container">
            <button type="submit" class="app-button">
                {{empty($product) ? 'Agregar Producto' : 'Editar producto'}}
            </button>
            <button class="app-button-danger">
                <a href="{{route('product.products')}}">Cancelar</a>
            </button>
        </div>
    </form>
@endsection

