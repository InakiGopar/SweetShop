<?php
namespace App\Services;

use App\Models\Order;

class OrderService 
{
    private string $FILTER = 'mis-pedidos';

    public function getOrders(string $filter = null) {

        //me traigo solo los pedidos del usuario
        if($filter === $this->FILTER) {
            return Order::myOrders($filter)->get();
        }

        //me traigo todos los pedidos de la base de datos
        return Order::get();
    }

    public function storeOrder(array $data, int $userId)
    {
        //crear un nuevo registro en la tabla Order
        $order = Order::create([
            'user_id' => $userId,
            'quantity' => array_sum($data['products'])
        ]);

        // Asociar productos con cantidades en la tabla pivote
        foreach ($data['products'] as $productId => $quantity) {
            if ($quantity > 0) {
                $order->products()->attach($productId, ['quantity' => $quantity]);
            }
        }

        return $order;
    }


    public function updateOrder(Order $order, array $data) {
        $order->update([
            'quantity' => array_sum($data['products']),
            'status' => $data['status'],
        ]);

        // Sincronizar con la tabla pivote
        $productsWithQuantities = [];
        foreach ($data['products'] as $product_id => $quantity) {
            if ($quantity > 0) {
                $productsWithQuantities[$product_id] = ['quantity' => $quantity];
            }
        }

        $order->products()->sync($productsWithQuantities);
        
        return $order;
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
    }

    public function calculateTotal(Order $order) {
        $totalPrice = $order->products->sum(function ($product) {
            return $product->pivot->quantity * $product->price;
        }); 
        
        return $totalPrice;
    }

}