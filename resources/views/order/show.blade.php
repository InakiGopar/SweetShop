
@extends('layouts.details')

@section('content')
    <div class="details">
        <!--Mensaje al usario que le informa si se completo la accion que solicito-->
        @if (session()->has('message'))
            <div class="message-container">
                <span> {{session('message')}}</span>
            </div>
        @endif

        <div class="order-details">
            <h3>Detalle del Pedido #{{ $order->id }}</h3>
            <p>Pedido realizado por <span class="order-name">{{ $order->user->name }}</span></p>
        </div>
        
        <div class="order-products">
            <p>Total de productos pedidos: {{ $order->products->sum('pivot.quantity') }}</p>    
            <ul >
                @foreach($order->products as $product)
                    <li> {{ $product->pivot->quantity }}  {{ $product->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="button-back">
        <button class="btn btn-primary">
            <a href="{{route('order.orders')}}">Volver</a>
        </button>
    </div>
@endsection

