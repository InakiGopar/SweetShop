<?php

namespace App\Livewire;

use App\Services\ProductService;
use Livewire\Component;

class ProductsList extends Component
{
    public string $filter = '';
    public string $productSearch = '';

    public function showAll() {
        $this->filter = '';
        $this->productSearch = '';
    }

    public function render()
    {
        $products = (new ProductService())->getProducts($this->filter, $this->productSearch);
        return view('livewire.products-list', ['products' => $products]);
    }
}
