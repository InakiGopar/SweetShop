<?php

namespace App\Livewire;

use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

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
