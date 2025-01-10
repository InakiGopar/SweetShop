<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\TestRunner\TestResult\Collector;

class OrderForm extends Component
{
    public Collection $allProducts;
    public Collection $products;
    public ?Order $order;
    public array $quantities = [];
    public int $total = 0;
    public string $search = '';
    public string $filter = '';

    public function mount($products, $order = null) 
    {
        $this->allProducts = $products;
        $this->products = $products;
        $this->order = $order;

        //This loop initializes the $quantities array, which associates each product with its selected quantity.
        foreach($this->allProducts as $product) {
            $this->quantities[$product->id] = $order
                ? ($order->products->where('id', $product->id)->first()?->pivot->quantity ?? 0)
                : 0;
        }

        $this->calculateTotal();
    }

    //Update the filter to choose sweet or salty products
    public function updatedFilter()
    {
        $this->updateProductList();
    }

    //Update the search query products
    public function updatedSearch()
    {
        $this->updateProductList();
    }

    //calculate the total price of the buy
    public function updatedQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        // This loop calculates the total cost of the order (selected quantity × price).
        foreach ($this->quantities as $productId => $quantity) {
            $product = $this->allProducts->firstWhere('id', $productId);
            if ($product) {
                $this->total += $quantity * $product->price;
            }
        }
    }

    private function updateProductList()
    {
        // Dynamically filter products based on the search query or sweet/salty products
        $this->products = (new ProductService())->getProducts($this->filter, $this->search);
    }


    public function render()
    {
        return view('livewire.order-form');
    }
}
