<?php

namespace App\Livewire;

use App\Services\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class OrderNotification extends Component
{
    public Collection $orders;
    public bool $showOrders;

    public function mount()
    {
        $this->orders = (new OrderService())->getPendingOrders();
        $this->showOrders = false;
    }

    public function showPendingOrders() {
        $this->showOrders = !$this->showOrders;
    }

    public function render()
    {
        return view('livewire.order-notification');
    }
}
