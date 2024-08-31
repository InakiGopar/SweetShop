<?php

namespace App\Livewire;

use App\Http\Controllers\product\ProductController;
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
        $products = app()->call([new ProductController(), 'getProducts'],
            ['request' => request()->merge(['filtro' => $this->filter])]);
        
        return view('livewire.products-list', ['products' => $products]);
    }
}
