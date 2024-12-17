<?php

namespace App\Livewire;

use Livewire\Component;

class OrderForm extends Component
{
    public $products;
    public $order;
    public $quantities = [];
    public $total = 0;

    public function mount($products, $order = null) 
    {
        $this->products = $products;
        $this->order = $order;

        //Este bucle inicializa el array $quantities, que asocia cada producto con su cantidad seleccionada.
        // El valor depende de si el componente está creando un pedido nuevo o editando uno existente.
        foreach ($this->products as $product) {
            $this->quantities[$product->id] = $order
                ? ($order->products->where('id', $product->id)->first()?->pivot->quantity ?? 0)
                : 0;
        }

        $this->calculateTotal();
    }

    public function updatedQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        // Este bucle calcula el costo total del pedido
        // sumando los subtotales de cada producto (cantidad seleccionada × precio unitario).
        foreach ($this->quantities as $productId => $quantity) {
            $product = $this->products->firstWhere('id', $productId);
            if ($product) {
                $this->total += $quantity * $product->price;
            }
        }
    }


    public function render()
    {
        return view('livewire.order-form');
    }
}
