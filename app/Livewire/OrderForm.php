<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ProductService;

class OrderForm extends Component
{
    public $products;
    public $order;
    public $quantities = [];
    public $total = 0;
    public $search = ''; 

    public function mount($products, $order = null) 
    {
        $this->products = $products;
        $this->order = $order;

        //This loop initializes the $quantities array, which associates each product with its selected quantity.
        foreach($this->products as $product) {
            $this->quantities[$product->id] = $order
                ? ($order->products->where('id', $product->id)->first()?->pivot->quantity ?? 0)
                : 0;
        }

        $this->calculateTotal();
    }

    public function updatedSearch()
    {
        // Dynamically filter products based on the search query
        $this->products = (new ProductService())->getProducts(null, $this->search);
    }

    public function updatedQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        // This loop calculates the total cost of the order (selected quantity × price).
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
