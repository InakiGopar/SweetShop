<?php

namespace App\Livewire;

use App\Services\ProductService;
use Livewire\Component;

class ProductsList extends Component
{
    public string $filter = '';

    public function updatedFilter($value)
    {
        $this->filter = $value;
    }

    public function render()
    {
        $products = (new ProductService())->getProducts($this->filter);
        
        return view('livewire.products-list', ['products' => $products]);
    }
}
