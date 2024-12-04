<?php

namespace App\Livewire;

use App\Services\OrderService;
use Livewire\Component;

class OrderList extends Component
{
    public string $filter = '';

    
    public function updatedFilter($value) {
        $this->filter = $value;
    }

    public function render()
    {
        $orders = (new OrderService())->getOrders($this->filter);
        
        return view('livewire.order-list', ['orders' => $orders]);
    }
}
