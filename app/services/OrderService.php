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
        //dd($data['products']);
        // Create a new order
        $order = Order::create([
            'user_id' => $userId,
            'quantity' => array_sum($data['products']), // Total quantity from all products
        ]);
    
        // Attach products with quantities to the order
        $productsWithQuantities = [];
        foreach ($data['products'] as $productId => $quantity) {
            if ($quantity > 0) { // Ignore products with 0 quantity
                $productsWithQuantities[$productId] = ['quantity' => $quantity];
            }
        }
    
        $order->products()->attach($productsWithQuantities);
    
        return $order;
    }   


    public function updateOrder(Order $order, array $data)
    {
        $order->update([
            'quantity' => array_sum($data['products']), // Total quantity
            'status' => $data['status'], // Update status
        ]);

        // Sync all products and quantities
        $productsWithQuantities = [];
        foreach ($data['products'] as $productId => $quantity) {
            if ($quantity > 0) {
                $productsWithQuantities[$productId] = ['quantity' => $quantity];
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